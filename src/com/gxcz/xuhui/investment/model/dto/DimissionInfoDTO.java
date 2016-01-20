package com.gxcz.xuhui.investment.model.dto;

import java.io.Serializable;
import java.math.BigDecimal;
import java.util.Date;

public class DimissionInfoDTO implements Serializable{

	private PagerDTO pager;

	private String csrId;

	private String projectId;

	private String uid;

	private BigDecimal contributiveAmount;

	private BigDecimal leverageAmount;

	private BigDecimal contributiveConfirmAmount;

	private BigDecimal bonusAmount;

	private BigDecimal completeBonusAmount;

	private BigDecimal adjustamt;

	private Integer status;

	private String projectName;

	private String uName;

	private String bankId;

	private String bankNo;

	private BigDecimal confirmLeverageAmt;

	private BigDecimal adjustLeverageAmt;

	private String number;

	private String service;

	private String duty;

	private String subType = "选投包";

	private boolean isRemissionSubscribe; // 是否豁免认购

	private BigDecimal confirmationPayment; // 缴款确认金额，该值来源：缴款确认导入缴款金额，同一项目同一人不同批次缴款的累计金额
	
	private boolean isDimission; // 是否离职
	
	private Date dimissionDate; // 离职日期
	
	private BigDecimal dimissionAmt; // 退款金额
	
	private BigDecimal piAmt;

	public Date getDimissionDate() {
		return dimissionDate;
	}

	public void setDimissionDate(Date dimissionDate) {
		this.dimissionDate = dimissionDate;
	}

	public BigDecimal getDimissionAmt() {
		return dimissionAmt;
	}

	public void setDimissionAmt(BigDecimal dimissionAmt) {
		this.dimissionAmt = dimissionAmt;
	}

	public PagerDTO getPager() {
		return pager;
	}

	public void setPager(PagerDTO pager) {
		this.pager = pager;
	}

	public String getCsrId() {
		return csrId;
	}

	public void setCsrId(String csrId) {
		this.csrId = csrId;
	}

	public String getProjectId() {
		return projectId;
	}

	public void setProjectId(String projectId) {
		this.projectId = projectId;
	}

	public String getUid() {
		return uid;
	}

	public void setUid(String uid) {
		this.uid = uid;
	}

	public BigDecimal getContributiveAmount() {
		return contributiveAmount;
	}

	public void setContributiveAmount(BigDecimal contributiveAmount) {
		this.contributiveAmount = contributiveAmount;
	}

	public BigDecimal getLeverageAmount() {
		return leverageAmount;
	}

	public void setLeverageAmount(BigDecimal leverageAmount) {
		this.leverageAmount = leverageAmount;
	}

	public BigDecimal getContributiveConfirmAmount() {
		return contributiveConfirmAmount;
	}

	public void setContributiveConfirmAmount(BigDecimal contributiveConfirmAmount) {
		this.contributiveConfirmAmount = contributiveConfirmAmount;
	}

	public BigDecimal getBonusAmount() {
		return bonusAmount;
	}

	public void setBonusAmount(BigDecimal bonusAmount) {
		this.bonusAmount = bonusAmount;
	}

	public BigDecimal getCompleteBonusAmount() {
		return completeBonusAmount;
	}

	public void setCompleteBonusAmount(BigDecimal completeBonusAmount) {
		this.completeBonusAmount = completeBonusAmount;
	}

	public BigDecimal getAdjustamt() {
		return adjustamt;
	}

	public void setAdjustamt(BigDecimal adjustamt) {
		this.adjustamt = adjustamt;
	}

	public Integer getStatus() {
		return status;
	}

	public void setStatus(Integer status) {
		this.status = status;
	}

	public String getProjectName() {
		return projectName;
	}

	public void setProjectName(String projectName) {
		this.projectName = projectName;
	}

	public String getuName() {
		return uName;
	}

	public void setuName(String uName) {
		this.uName = uName;
	}

	public String getBankId() {
		return bankId;
	}

	public void setBankId(String bankId) {
		this.bankId = bankId;
	}

	public String getBankNo() {
		return bankNo;
	}

	public void setBankNo(String bankNo) {
		this.bankNo = bankNo;
	}

	public BigDecimal getConfirmLeverageAmt() {
		return confirmLeverageAmt;
	}

	public void setConfirmLeverageAmt(BigDecimal confirmLeverageAmt) {
		this.confirmLeverageAmt = confirmLeverageAmt;
	}

	public BigDecimal getAdjustLeverageAmt() {
		return adjustLeverageAmt;
	}

	public void setAdjustLeverageAmt(BigDecimal adjustLeverageAmt) {
		this.adjustLeverageAmt = adjustLeverageAmt;
	}

	public String getNumber() {
		return number;
	}

	public void setNumber(String number) {
		this.number = number;
	}

	public String getService() {
		return service;
	}

	public void setService(String service) {
		this.service = service;
	}

	public String getDuty() {
		return duty;
	}

	public void setDuty(String duty) {
		this.duty = duty;
	}

	public String getSubType() {
		return subType;
	}

	public void setSubType(String subType) {
		this.subType = subType;
	}

	public boolean isRemissionSubscribe() {
		return isRemissionSubscribe;
	}

	public void setRemissionSubscribe(boolean isRemissionSubscribe) {
		this.isRemissionSubscribe = isRemissionSubscribe;
	}

	public BigDecimal getConfirmationPayment() {
		return confirmationPayment;
	}

	public void setConfirmationPayment(BigDecimal confirmationPayment) {
		this.confirmationPayment = confirmationPayment;
	}

	public boolean isDimission() {
		return isDimission;
	}

	public void setDimission(boolean isDimission) {
		this.isDimission = isDimission;
	}

	public BigDecimal getPiAmt() {
		return piAmt;
	}

	public void setPiAmt(BigDecimal piAmt) {
		this.piAmt = piAmt;
	}
}
