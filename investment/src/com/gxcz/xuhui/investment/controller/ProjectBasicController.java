package com.gxcz.xuhui.investment.controller;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;
import java.util.UUID;

import javax.servlet.http.HttpSession;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.propertyeditors.CustomDateEditor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.gxcz.xuhui.investment.model.ProjectBasicInfo;
import com.gxcz.xuhui.investment.model.SubscribeSummaryInfo;
import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.ProjectBasicInfoDTO;
import com.gxcz.xuhui.investment.model.dto.ResultDTO;
import com.gxcz.xuhui.investment.service.ICompleteSubscribeRecordService;
import com.gxcz.xuhui.investment.service.impl.IProjectBasicService;
import com.gxcz.xuhui.investment.service.impl.IUserProjectRelateService;
@Controller
@RequestMapping("/ProjectBasicController")
public class ProjectBasicController {
	private final Logger logger =Logger.getLogger(ProjectBasicController.class);
	SimpleDateFormat sdf=new SimpleDateFormat("yyyy/MM/dd hh:mm");
	IProjectBasicService projectBasicService=null;
	IUserProjectRelateService userProjectRelateService=null;
	ICompleteSubscribeRecordService completeSubscribeRecordService=null;
	
	@RequestMapping("/deleteSchemeProtocal")
	@ResponseBody
	public ResultDTO deleteSchemeProtocal(@RequestParam("projectId") String projectId, @RequestParam("protocalLink") String protocalLink){
		ResultDTO resultDto=new ResultDTO();
		try{
			ProjectBasicInfo projectBasicInfo = new ProjectBasicInfo();
			projectBasicInfo.setProjectId(projectId);
			projectBasicInfo.setSchemeProtocol(protocalLink);
			projectBasicService.updateByPrimaryKeySelective(projectBasicInfo);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/saveOrUpdate")
	public String saveOrUpdate(@ModelAttribute("form") ProjectBasicInfoDTO projectdto){
		ResultDTO resultDto=new ResultDTO();
		ProjectBasicInfo record=new ProjectBasicInfo();
		try{
			record=projectdto.toModelVO(projectdto);
			int resultint=0;
			if(!"null".equals(record.getProjectId())&&!"".equals(record.getProjectId()) && record.getProjectId()!=null){
				resultint=projectBasicService.updateByPrimaryKey(record);
			}else{
				record.setProjectId(UUID.randomUUID().toString());
				resultint=projectBasicService.insert(record);
			}
			resultDto.setBaseModel(record);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return "redirect:/back/projectManage.jsp?projectId="+record.getProjectId();
	}

	@RequestMapping("/update")
	@ResponseBody
	public ResultDTO update(@RequestParam("projectId") String projectId,
			@RequestParam("projectName") String projectName,
			@RequestParam("projectArea") String projectArea){
		ResultDTO resultDto=new ResultDTO();
		ProjectBasicInfo basicInfo=new ProjectBasicInfo();
		
		try{
			basicInfo.setProjectId(projectId);
			basicInfo.setProjectName(projectName);
			basicInfo.setProjectarea(projectArea);
			projectBasicService.updateByPrimaryKey(basicInfo);
			resultDto.setBaseModel(basicInfo);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());			
		}
		
		return resultDto;
	}
	
	@RequestMapping("/insert")
	@ResponseBody
	public ResultDTO insert(ProjectBasicInfo record){
		ResultDTO resultDto=new ResultDTO();
		try{
			record.setProjectId(UUID.randomUUID().toString());
			int resultint=projectBasicService.insert(record);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	 /* 
 	  * 表单提交日期绑定 
 	  */  
	 @InitBinder  
	 public void initBinder(WebDataBinder binder) {  
	     SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");  
	     dateFormat.setLenient(false);  
	     binder.registerCustomEditor(Date.class, new CustomDateEditor(dateFormat, true));  
	 }  
	   
	@RequestMapping("/getProjectById")
	@ResponseBody
	public ResultDTO getProjectById(@RequestParam("projectId") String projectId){
		ResultDTO resultDto=new ResultDTO();
		try{
			ProjectBasicInfo projectBasicInfo =projectBasicService.selectByPrimaryKey(projectId);
			//查询项目的项目管理员 跟项目的跟投
//			List<UserInfoDTO> userInfoList= userProjectRelateService.getUserByProject(projectId);
//			StringBuffer restFollowerManagers=new StringBuffer(); //项目跟投管理员3
//			StringBuffer restProjectManagers=new StringBuffer();  //项目信息管理员2
//			for(int i=0;i<userInfoList.size();i++){
//				UserInfoDTO userInfoDto=userInfoList.get(i);
//				if("2".equals(userInfoDto.getType())){
//					restProjectManagers.append("名称："+userInfoDto.getUname()+"\n");
//					restProjectManagers.append("邮箱："+(userInfoDto.getUserprincipalname()==null?"":userInfoDto.getUserprincipalname())+"\n");
//					restProjectManagers.append("电话："+(userInfoDto.getMobilePhone()==null?"":userInfoDto.getMobilePhone()));
//				}else if("3".equals(userInfoDto.getType())){
//					restFollowerManagers.append("名称："+userInfoDto.getUname()+"\n");
//					restFollowerManagers.append("邮箱："+(userInfoDto.getUserprincipalname()==null?"":userInfoDto.getUserprincipalname())+"\n");
//					restFollowerManagers.append("电话："+(userInfoDto.getMobilePhone()==null?"":userInfoDto.getMobilePhone()));
//				}
//			}
//			projectBasicInfo.setRestProjectManagers(restProjectManagers.toString());
//			projectBasicInfo.setRestFollowerManagers(restFollowerManagers.toString());
			resultDto.setSuccess(true);
			resultDto.setBaseModel(projectBasicInfo);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	@RequestMapping("/updateProject")
	@ResponseBody
	public ResultDTO updateProject(@RequestBody ProjectBasicInfo record){
		ResultDTO resultDto=new ResultDTO();
		try{
			record.setProjectId(UUID.randomUUID().toString());
			int resultInt= projectBasicService.updateByPrimaryKey(record);
			resultDto.setSuccess(true);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDto.setSuccess(false);
			resultDto.setError(ex.getMessage());
		}
		return resultDto;
	}
	
	@RequestMapping("/getProjectList")
	@ResponseBody
	public ResultDTO getProjectList(HttpSession session,@RequestBody List<Map<String,Object>> fields){
		
		ResultDTO resultDTO=new ResultDTO();
		ProjectBasicInfoDTO projectBasicInfoDTO=new ProjectBasicInfoDTO();
		projectBasicInfoDTO.setPageSize(999);
		UserInfo userInfo=(UserInfo) session.getAttribute("userInfo");
		String filiable=userInfo.getFiliale();//当前用户所属区域
		try{
			for(int i =0;i<fields.size();i++){
				Map<String,Object> map=fields.get(i);
				String name=(String) map.get("name");
				Object val=map.get("value");
				if(name.equals("releaseStartDate") && !"".equals(val))
					projectBasicInfoDTO.setReleaseStartDate(val.toString());
				if(name.equals("releaseEndDate") && !"".equals(val))
					projectBasicInfoDTO.setReleaseEndDate(val.toString());
				if(name.equals("projectName") && !"".equals(val))
					projectBasicInfoDTO.setSearchName((String)val);
				if(name.equals("isPerson") && !"".equals(val))
					projectBasicInfoDTO.setIsperson((String)val);
			}
			logger.info("当前用户的分公司是："+userInfo.getFiliale());
			if(!"A.集团总部".equals(userInfo.getFiliale())){
				//projectBasicInfoDTO.setFiliableName(filiable);
			}
			projectBasicInfoDTO.setUserid(userInfo.getUid());
			projectBasicInfoDTO.setUname(userInfo.getUname());
			List<ProjectBasicInfoDTO> list=projectBasicService.getProjectList(projectBasicInfoDTO);
			for(int i=0;i<list.size();i++){
				ProjectBasicInfoDTO projectBasicDto=list.get(i);
				SubscribeSummaryInfo summary =completeSubscribeRecordService.getSubscribeSummaryByProjectId(projectBasicDto.getProjectId());
				projectBasicDto.setSubscribeAmt(summary.getSubscribeAmt());
			}
			resultDTO.setSuccess(true);
			resultDTO.setDataDto(list);
		}catch(Exception ex){
			ex.printStackTrace();
			resultDTO.setSuccess(false);
			resultDTO.setError(ex.getMessage());
		}
		return resultDTO;
	}
	
	@RequestMapping(value = "/subscribeProtocalList")
	public @ResponseBody ResultDTO fetchPorjectSubscribeProtocalList(@RequestParam String projectId) {
		ResultDTO resultDTO = new ResultDTO();
		List<String> protocalList = new ArrayList<String>();
		try {
			String protocal = projectBasicService.fetchPorjectSubscribeProtocalList(projectId);
			if(protocal != null){
				String[] protocalArray = protocal.split(";");
				for(int i = 0; i < protocalArray.length; i++){
					protocalList.add(protocalArray[i]);
				}
			}
			resultDTO.setSuccess(true);
		} catch (Exception e) {
			logger.error(e.getMessage());
			e.printStackTrace();
		}
		resultDTO.setDataDto(protocalList);
		return resultDTO;
	}
	
	public IProjectBasicService getProjectBasicService() {
		return projectBasicService;
	}
	@Autowired
	public void setProjectBasicService(IProjectBasicService projectBasicService) {
		this.projectBasicService = projectBasicService;
	}
	public IUserProjectRelateService getUserProjectRelateService() {
		return userProjectRelateService;
	}
	@Autowired
	public void setUserProjectRelateService(IUserProjectRelateService userProjectRelateService) {
		this.userProjectRelateService = userProjectRelateService;
	}
	public ICompleteSubscribeRecordService getCompleteSubscribeRecordService() {
		return completeSubscribeRecordService;
	}
	@Autowired
	public void setCompleteSubscribeRecordService(ICompleteSubscribeRecordService completeSubscribeRecordService) {
		this.completeSubscribeRecordService = completeSubscribeRecordService;
	}
	
}
