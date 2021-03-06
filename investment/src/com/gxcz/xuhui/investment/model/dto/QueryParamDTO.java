package com.gxcz.xuhui.investment.model.dto;

public class QueryParamDTO {
	
	private PagerDTO pager;
	
	private String projectId;
	
	private String projectName;
	
	private String uid;
	
	private String uName;
	
	private int status;
	
	private int pageSize = 50;
	private int endPage;
	private int startPage;
	private String bankId;
	private String numberCode;
	
	private boolean isDimission;

	public boolean isDimission() {
		return isDimission;
	}

	public void setDimission(boolean isDimission) {
		this.isDimission = isDimission;
	}

	public int getStatus() {
		return status;
	}

	public void setStatus(int status) {
		this.status = status;
	}

	public String getProjectId() {
		return projectId;
	}

	public void setProjectId(String projectId) {
		this.projectId = projectId;
	}

	public String getProjectName() {
		return projectName;
	}

	public void setProjectName(String projectName) {
		this.projectName = projectName;
	}

	public String getUid() {
		return uid;
	}

	public void setUid(String uid) {
		this.uid = uid;
	}

	public String getuName() {
		return uName;
	}

	public void setuName(String uName) {
		this.uName = uName;
	}

	public PagerDTO getPager() {
		return pager;
	}

	public void setPager(PagerDTO pager) {
		this.pager = pager;
	}

	public int getPageSize() {
		return pageSize;
	}

	public void setPageSize(int pageSize) {
		this.pageSize = pageSize;
	}

	public int getEndPage() {
		return endPage;
	}

	public void setEndPage(int endPage) {
		this.endPage = endPage;
	}

	public int getStartPage() {
		return startPage;
	}

	public void setStartPage(int startPage) {
		this.startPage = startPage;
	}

	public String getBankId() {
		return bankId;
	}

	public void setBankId(String bankId) {
		this.bankId = bankId;
	}

	public String getNumberCode() {
		return numberCode;
	}

	public void setNumberCode(String numberCode) {
		this.numberCode = numberCode;
	}	

}
