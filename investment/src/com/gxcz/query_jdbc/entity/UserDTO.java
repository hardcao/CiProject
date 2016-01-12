package com.gxcz.query_jdbc.entity;

public class UserDTO {
	/**
	 * 用户姓名
	 */
	private String name;
	/**
	 * 
	 */
	private String whenChanged;
	/**
	 * 帐号状态：1/禁用    2/正常使用
	 */
	private String status;
	
	/**
	 * 帐号
	 */
	private String sAMAccountName;
	
	/**
	 * 帐号@cifi.com.cn
	 */
	private String userPrincipalName;
	
	
	/**
	 * 部门
	 */
	private String department;
	/**
	 * 服务行业
	 */
	private String service;
	/**
	 * 分公司
	 */
	private String filiale;
	/**
	 * 总部
	 */
	private String headquarters;
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getWhenChanged() {
		return whenChanged;
	}
	public void setWhenChanged(String whenChanged) {
		this.whenChanged = whenChanged;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public String getsAMAccountName() {
		return sAMAccountName;
	}
	public void setsAMAccountName(String sAMAccountName) {
		this.sAMAccountName = sAMAccountName;
	}
	public String getUserPrincipalName() {
		return userPrincipalName;
	}
	public void setUserPrincipalName(String userPrincipalName) {
		this.userPrincipalName = userPrincipalName;
	}
	public String getDepartment() {
		return department;
	}
	public void setDepartment(String department) {
		this.department = department;
	}
	public String getService() {
		return service;
	}
	public void setService(String service) {
		this.service = service;
	}
	public String getFiliale() {
		return filiale;
	}
	public void setFiliale(String filiale) {
		this.filiale = filiale;
	}
	public String getHeadquarters() {
		return headquarters;
	}
	public void setHeadquarters(String headquarters) {
		this.headquarters = headquarters;
	}
	public UserDTO() {
		super();
		// TODO Auto-generated constructor stub
	}
	public UserDTO(String name, String whenChanged, String status,
			String sAMAccountName, String userPrincipalName, String department,
			String service, String filiale, String headquarters) {
		super();
		this.name = name;
		this.whenChanged = whenChanged;
		this.status = status;
		this.sAMAccountName = sAMAccountName;
		this.userPrincipalName = userPrincipalName;
		this.department = department;
		this.service = service;
		this.filiale = filiale;
		this.headquarters = headquarters;
	}
	
	
	
}
