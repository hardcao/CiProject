package com.gxcz.common.util;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.math.BigDecimal;
import java.text.ParseException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.UUID;

import javax.servlet.http.HttpServletResponse;

import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.DataFormatter;
import org.apache.poi.ss.usermodel.DateUtil;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.multipart.commons.CommonsMultipartFile;

import com.gxcz.xuhui.investment.model.BonusDetail;
import com.gxcz.xuhui.investment.model.CompleteSubscribeRecord;
import com.gxcz.xuhui.investment.model.PayInDetail;
import com.gxcz.xuhui.investment.model.dto.BonusDetailDTO;
import com.gxcz.xuhui.investment.model.dto.CompleteSubscribeRecordDTO;
import com.gxcz.xuhui.investment.model.dto.DimissionInfoDTO;
import com.gxcz.xuhui.investment.model.dto.PayInDetailDTO;
import com.gxcz.xuhui.investment.model.dto.QueryParamDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IBonusDetailService;

public class ExcelUtil {

	private static final int version2003 = 2003;

	private static final int version2007 = 2007; // 2007以上版本

	private static int version = version2003;

	private static Workbook wb = null;

	private static Sheet sheet = null;

	private static Cell cell = null;

	private static Row row = null;

	/**
	 * 用于导入 获取excel 的数组
	 * 
	 * @param excelFilePath
	 * @return
	 * @throws IOException
	 */
	private static String[][] getExcelStr(CommonsMultipartFile file, String fileName, int beginRow) throws IOException {
		// 判断类型 2003，2007
		if (fileName.endsWith(".xls")) {
			version = version2003;
		} else if (fileName.endsWith(".xlsx")) {
			version = version2007;
		}

		InputStream stream = null;
		if (version == version2003) {
			stream = file.getInputStream();
			wb = (Workbook) new HSSFWorkbook(stream);
		} else if (version == version2007) {
			wb = (Workbook) new XSSFWorkbook(file.getInputStream());
		}

		sheet = wb.getSheetAt(0);
		// 行数(从0开始,相当于最后一行的索引),列数

		int count_row = sheet.getLastRowNum();
		for (int i = 0; i < count_row; i++) {
			row = sheet.getRow(i + beginRow); // 年模板，从第三行开始读
			cell = row.getCell(0);
			if (cell.getStringCellValue() == null || cell.getStringCellValue().equals("")) {
				count_row = i + beginRow;
				break;
			}
		}
		int count_cell = sheet.getRow(0).getPhysicalNumberOfCells();
		String[][] str = new String[count_row][count_cell];
		for (int i = 0; i < count_row; i++) {
			for (int j = 0; j < count_cell; j++) {
				row = sheet.getRow(i + beginRow);
				cell = row.getCell(j);
				int type = cell.getCellType(); // 得到单元格数据类型
				String k = "";
				if (type == Cell.CELL_TYPE_STRING) {
					if (cell.getStringCellValue() == null) {
						break;
					}
				}
				switch (type) { // 判断数据类型
				case Cell.CELL_TYPE_NUMERIC:
					if (DateUtil.isCellDateFormatted(cell)) {
						k = new DataFormatter().formatRawCellContents(cell.getNumericCellValue(), 0, "yyyy-mm-dd");//
					} else {
						k = cell.getNumericCellValue() + "";
					}
					break;
				case Cell.CELL_TYPE_STRING:
					k = cell.getStringCellValue();
					break;
				case Cell.CELL_TYPE_FORMULA:
					k = cell.getCellFormula();
					break;
				case Cell.CELL_TYPE_BLANK:
					k = "";
					break;
				case Cell.CELL_TYPE_BOOLEAN:
					k = cell.getBooleanCellValue() + "";
					break;
				case Cell.CELL_TYPE_ERROR:
					k = cell.getErrorCellValue() + "";
					break;
				default:
					break;
				}
				str[i][j] = k;
			}
		}
		cell = null;
		row = null;
		sheet = null;
		wb = null;
		return str;
	}

	/**
	 * 导出文件的方法
	 * 
	 * @param wb
	 * @param srcFilePath
	 * @param response
	 */
	private static void exportFile(String filename, Workbook wb, String srcFilePath, HttpServletResponse response) {
		// File file = new File(srcFilePath);
		// // 取得文件名。
		// String filename = file.getName();
		String plex = srcFilePath.substring(srcFilePath.lastIndexOf("."));
		response.setContentType("application/vnd.ms-excel;charset=utf-8");
		response.setCharacterEncoding("utf-8");
		response.setHeader("Content-Disposition", "attachment;filename=" + filename + plex);
		try {
			OutputStream out = response.getOutputStream();
			wb.write(out);
			out.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导出模板
	 * 
	 * @param srcFilePath
	 * @param response
	 */
	// public static void excelTemplet(String srcFilePath, HttpServletResponse
	// response){
	// try {
	// InputStream in = new FileInputStream(srcFilePath);
	// wb = (Workbook)new XSSFWorkbook(in);
	// String filename = "模板"+BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
	// exportFile(filename,wb,srcFilePath,response);
	// } catch (FileNotFoundException e) {
	// // TODO Auto-generated catch block
	// e.printStackTrace();
	// } catch (IOException e) {
	// // TODO Auto-generated catch block
	// e.printStackTrace();
	// }
	// }

	/**
	 * 导入认购核准 修改核准数据
	 * 
	 * @param path
	 * @param uid
	 * @param projectId
	 * @return
	 * @throws IOException
	 */
	public static List<CompleteSubscribeRecord> readSubscribeExcel(CommonsMultipartFile file, String fileName) throws IOException, ParseException {
		String[][] str = getExcelStr(file, fileName, 3); // 读取excel
		List<CompleteSubscribeRecord> list = new ArrayList<CompleteSubscribeRecord>();
		for (int k = 0; k < str.length; k++) {
			String[] temp_str = str[k];
			if (temp_str[0].equals("")) {
				break;
			}
			CompleteSubscribeRecord record = new CompleteSubscribeRecord();
			for (int s = 0; s < temp_str.length; s++) {
				record.setNumber(temp_str[s]);
				record.setUid(temp_str[s + 1]); // 是用户名称
				record.setProjectId(temp_str[s + 2]); // 是用户所属项目，先传过去，再去查项目
				// record.setContributiveAmount(BaseUtil.getBigDecimal(temp_str[s+3]));
				// record.setLeverageAmount(BaseUtil.getBigDecimal(temp_str[s+4]));
				// record.setAdjustamt(BaseUtil.getBigDecimal(temp_str[s+5]));
				// record.setAdjustLeverageAmt(BaseUtil.getBigDecimal(temp_str[s+6]));
				// record.setContributiveConfirmAmount(BaseUtil.getBigDecimal(temp_str[s+7]));
				// record.setConfirmLeverageAmt(BaseUtil.getBigDecimal(temp_str[s+8]));

				record.setContributiveAmount(new BigDecimal(Float.parseFloat(temp_str[s + 5]) * 10000));
				record.setLeverageAmount(new BigDecimal(Float.parseFloat(temp_str[s + 6]) * 10000));
				// record.setAdjustamt(BaseUtil.getBigDecimal(temp_str[s+5]));
				// record.setAdjustLeverageAmt(BaseUtil.getBigDecimal(temp_str[s+6]));
				record.setContributiveConfirmAmount(new BigDecimal(Float.parseFloat(temp_str[s + 7]) * 10000));
				record.setConfirmLeverageAmt(new BigDecimal(Float.parseFloat(temp_str[s + 8]) * 10000));

				record.setBankNo(temp_str[s + 9]);
				list.add(record);
				break;
			}
		}
		return list;
	}

	/**
	 * 导出认购核准
	 * 
	 * @param srcFilePath
	 * @param newFile
	 * @param data
	 * @param response
	 */
	public static void writeSubscribeExcel(String srcFilePath, String newFile, List<CompleteSubscribeRecordDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);

			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 3);
					//
					CompleteSubscribeRecordDTO info = (CompleteSubscribeRecordDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumber());
					row.getCell(1).setCellValue(info.getuName());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(info.getSubType());
					row.getCell(5).setCellValue(Double.parseDouble(info.getContributiveAmount().toString()) / 10000);
					row.getCell(6).setCellValue(Double.parseDouble(info.getLeverageAmount().toString()) / 10000);
					// row.getCell(5).setCellValue(Double.parseDouble(info.getAdjustamt().toString())/10000);
					// row.getCell(6).setCellValue(Double.parseDouble(info.getAdjustLeverageAmt().toString())/10000);
					row.getCell(7).setCellValue(Double.parseDouble(info.getContributiveConfirmAmount().toString()) / 10000);
					row.getCell(8).setCellValue(Double.parseDouble(info.getConfirmLeverageAmt().toString()) / 10000);
					row.getCell(9).setCellValue(info.getBankNo());
				}
			}
			// 生成文件
			// FileOutputStream out = new FileOutputStream(newFilePath);
			// wb.write(out);
			// out.close();
			String filename = "ExportSubscribe-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);

		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导出离职人员数据
	 * 
	 * @param srcFilePath
	 * @param newFile
	 * @param data
	 * @param response
	 */
	public static void writeDimissionExcel(String srcFilePath, String newFile, List<DimissionInfoDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);

			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 3);
					
					DimissionInfoDTO info = (DimissionInfoDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumber());
					row.getCell(1).setCellValue(info.getuName());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(Double.parseDouble(info.getContributiveAmount().toString()) / 10000);
					row.getCell(5).setCellValue(Double.parseDouble(info.getLeverageAmount().toString()) / 10000);
					row.getCell(6).setCellValue(Double.parseDouble(info.getPiAmt().toString()) / 10000);
					row.getCell(7).setCellValue(info.getBankNo());
					row.getCell(8).setCellValue(info.getDimissionDate());
					row.getCell(9).setCellValue(Double.parseDouble(info.getPiAmt().toString()) / 10000);
				}
			}
			// 生成文件
			// FileOutputStream out = new FileOutputStream(newFilePath);
			// wb.write(out);
			// out.close();
			String filename = "ExportDimission-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导出认购 Excel 分红模板
	 * 
	 * @param srcFilePath
	 * @param newFilePath
	 * @param data
	 * @param response
	 */
	public static void writeSubscribeRecordDTOExcel(String srcFilePath, String newFilePath, List<CompleteSubscribeRecordDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);
			sheet.getRow(0).getCell(0).setCellValue("认购记录");
			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 2);
					// 导出认购
					CompleteSubscribeRecordDTO info = (CompleteSubscribeRecordDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumber());
					row.getCell(1).setCellValue(info.getuName());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(info.getSubType());
					// row.getCell(5).setCellValue(Double.parseDouble(info.getLeverageAmount().add(info.getContributiveAmount()).toString())/10000);
					row.getCell(5).setCellValue(Double.parseDouble(info.getContributiveConfirmAmount().toString()) / 10000);
					row.getCell(6).setCellValue(1);
					row.getCell(7).setCellValue(new Date());
					row.getCell(8).setCellValue(5);
					row.getCell(9).setCellValue(info.getBankNo());
					row.getCell(10).setCellValue("分红");
				}
			}
			// 生成文件
			// FileOutputStream out = new FileOutputStream(newFilePath);
			// wb.write(out);
			// out.close();
			String filename = "ExportSubForBonus-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);

		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导入分红明细Excel
	 * 
	 * @param excelFilePath
	 * @param userId
	 * @param projectId
	 * @return
	 * @throws IOException
	 * @throws ParseException
	 */
	public static List<BonusDetail> readBonusDetailExcel(CommonsMultipartFile file, String fileName, ICompleteSubscribeRecordService completeSubscribeRecordService) throws IOException, ParseException {
		String[][] str = getExcelStr(file, fileName, 2); // 读取excel
		List<BonusDetail> list = new ArrayList<BonusDetail>();
		QueryParamDTO queryDto = new QueryParamDTO();
		CompleteSubscribeRecordDTO record = new CompleteSubscribeRecordDTO();
		for (int k = 0; k < str.length; k++) {
			String[] temp_str = str[k];
			if (temp_str[0].equals("")) {
				break;
			}
			BonusDetail bonusDetail = new BonusDetail();
			for (int s = 0; s < temp_str.length; s++) {
				String number = temp_str[s];// 认购的编码

				queryDto = new QueryParamDTO();
				queryDto.setNumberCode(number);
				List<CompleteSubscribeRecordDTO> recordList = completeSubscribeRecordService.queryAllUnCompleteRecord(queryDto);
				if (recordList.size() > 0) {
					record = recordList.get(0);
				}

				bonusDetail.setRecordNumber(number);
				// bonusDetail.setProjectId(number);// 先放认购的编码，到insertBath语句中用到
				bonusDetail.setProjectId(record.getProjectId());
				// bonusDetail.setUserid(number);// 先放认购的编码，到insertBath语句中用到
				bonusDetail.setUserid(record.getUid());
				bonusDetail.setNumber(BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmssSSS") + k);
				bonusDetail.setSubscribeType(temp_str[s + 4]);
				// bonusDetail.setSubscribeAmount(BaseUtil.getBigDecimal(temp_str[s+4]));
				bonusDetail.setSubscribeAmount(new BigDecimal(Float.parseFloat(temp_str[s + 5]) * 10000));
				bonusDetail.setBonusTimes(BaseUtil.getBigDecimal(temp_str[s + 6]));
				bonusDetail.setBonusDate(BaseUtil.toChangeStringToDate(temp_str[s + 7]));
				// bonusDetail.setBonusAmount(BaseUtil.getBigDecimal(temp_str[s+7]));
				bonusDetail.setBonusAmount(new BigDecimal(Float.parseFloat(temp_str[s + 8]) * 10000));
				bonusDetail.setCompleteSubscribeRecord(temp_str[s + 10]);
				bonusDetail.setBonusId(UUID.randomUUID().toString());
				list.add(bonusDetail);
				break;
			}
		}
		return list;
	}

	/**
	 * 导出分红明细 Excel
	 * 
	 * @param srcFilePath
	 * @param newFilePath
	 * @param data
	 * @param response
	 */
	public static void writeBonusDetailExcel(String srcFilePath, String newFilePath, List<BonusDetailDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);
			sheet.getRow(1).getCell(0).setCellValue("分红明细编码");
			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 2);
					// 分红明细
					BonusDetailDTO info = (BonusDetailDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumber());
					row.getCell(1).setCellValue(info.getUname());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(info.getSubscribeType());
					row.getCell(5).setCellValue(Double.parseDouble(info.getSubscribeAmount().toString()) / 10000);
					row.getCell(6).setCellValue(Double.parseDouble(info.getBonusTimes().toString()));
					row.getCell(7).setCellValue(info.getBonusDate());
					row.getCell(8).setCellValue(Double.parseDouble(info.getBonusAmount().toString()) / 10000);
					row.getCell(9).setCellValue(info.getSubscribePackageName());
					row.getCell(10).setCellValue(info.getCompleteSubscribeRecord());
				}
			}
			String filename = "ExportBonus-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);

		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导出认购 Excel 缴款确认模板
	 * 
	 * @param srcFilePath
	 * @param newFilePath
	 * @param data
	 * @param response
	 */
	public static void writeSubscribeRecordDTOByPI(String srcFilePath, String newFilePath, List<CompleteSubscribeRecordDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);
			sheet.getRow(0).getCell(0).setCellValue("认购记录");
			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 2);
					// 导出认购
					CompleteSubscribeRecordDTO info = (CompleteSubscribeRecordDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumber());
					row.getCell(1).setCellValue(info.getuName());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(info.getSubType());
					// row.getCell(5).setCellValue(Double.parseDouble(info.getLeverageAmount().add(info.getContributiveAmount()).toString())/10000);
					row.getCell(5).setCellValue(Double.parseDouble(info.getContributiveConfirmAmount().toString()) / 10000);
					row.getCell(6).setCellValue(1);
					row.getCell(7).setCellValue(new Date());
					row.getCell(8).setCellValue(2);
				}
			}
			String filename = "ExportSubForPayIn-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);

		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	/**
	 * 导入缴款明细Excel
	 * 
	 * @param excelFilePath
	 * @param userId
	 * @param projectId
	 * @return
	 * @throws IOException
	 * @throws ParseException
	 */
	public static List<PayInDetail> readPayInDetailExcel(CommonsMultipartFile file, String fileName, ICompleteSubscribeRecordService completeSubscribeRecordService) throws IOException, ParseException {
		String[][] str = getExcelStr(file, fileName, 2); // 读取excel
		List<PayInDetail> list = new ArrayList<PayInDetail>();
		QueryParamDTO queryDto = new QueryParamDTO();
		CompleteSubscribeRecordDTO record = new CompleteSubscribeRecordDTO();
		for (int k = 0; k < str.length; k++) {
			String[] temp_str = str[k];
			if (temp_str[0].equals("")) {
				break;
			}
			// BonusDetail bonusDetail=new BonusDetail();
			PayInDetail payInDetail = new PayInDetail();
			for (int s = 0; s < temp_str.length; s++) {
				String number = temp_str[s];// 认购的编码

				queryDto = new QueryParamDTO();
				queryDto.setNumberCode(number);
				List<CompleteSubscribeRecordDTO> recordList = completeSubscribeRecordService.queryAllUnCompleteRecord(queryDto);
				if (recordList.size() > 0) {
					record = recordList.get(0);
				}

				// payInDetail.setProjectId(number);// 先放认购的编码，到insertBath语句中用到
				payInDetail.setProjectId(record.getProjectId());
				// payInDetail.setUserId(number);// 先放认购的编码，到insertBath语句中用到
				payInDetail.setUserId(record.getUid());
				payInDetail.setNumberCode(BaseUtil.formatDate(new Date(), "yyyyMMdd-HHmmssSSS") + k);
				// payInDetail.setNumberCode(number);
				// bonusDetail.setSubscribeType(temp_str[s+3]);
				// payInDetail.setSubscribeAmt(BaseUtil.getBigDecimal((temp_str[s+3])));
				payInDetail.setSubscribeAmt(new BigDecimal(Float.parseFloat(temp_str[s + 5]) * 10000));
				payInDetail.setPiTimes(BaseUtil.getBigDecimal(temp_str[s + 6]));
				payInDetail.setPiDate(BaseUtil.toChangeStringToDate(temp_str[s + 7]));
				// payInDetail.setPiAmt(BaseUtil.getBigDecimal(temp_str[s+6]));
				payInDetail.setPiAmt(new BigDecimal(Float.parseFloat(temp_str[s + 8]) * 10000));
				payInDetail.setPiId(UUID.randomUUID().toString());
				list.add(payInDetail);
				break;
			}
		}
		return list;
	}

	/**
	 * 导出缴款明细 Excel
	 * 
	 * @param srcFilePath
	 * @param newFilePath
	 * @param data
	 * @param response
	 */
	public static void writePiListExcel(String srcFilePath, String newFilePath, List<PayInDetailDTO> data, HttpServletResponse response) {
		try {
			InputStream in = new FileInputStream(srcFilePath);
			// 读模板文件
			wb = (Workbook) new XSSFWorkbook(in);
			sheet = wb.getSheetAt(0);
			sheet.getRow(1).getCell(0).setCellValue("缴款编码");
			if (data != null && data.size() > 0) {
				for (int i = 0; i < data.size(); i++) {
					row = sheet.getRow(i + 2);
					PayInDetailDTO info = (PayInDetailDTO) data.get(i);
					row.getCell(0).setCellValue(info.getNumberCode());
					row.getCell(1).setCellValue(info.getUname());
					row.getCell(2).setCellValue(info.getProjectName());
					row.getCell(3).setCellValue(info.getService());
					row.getCell(4).setCellValue(info.getSubType());
					// row.getCell(3).setCellValue(info.getSubscribeType());
					row.getCell(5).setCellValue(Double.parseDouble(info.getSubscribeAmt().toString()) / 10000);
					row.getCell(6).setCellValue(Double.parseDouble(info.getPiTimes().toString()));
					row.getCell(7).setCellValue(info.getPiDate());
					row.getCell(8).setCellValue(Double.parseDouble(info.getPiAmt().toString()) / 10000);
				}
			}
			String filename = "ExportPayIn-" + BaseUtil.formatDate(new Date(), "yyyyMMddHHmmss");
			exportFile(filename, wb, srcFilePath, response);

		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
}
