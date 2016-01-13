package com.gxcz.xuhui.investment.model;

public class UserInfo extends BaseModel {
	private String uid;

	private String uname;

	private String loginId;

	private String password;

	private String mobilePhone;

	private String telephone;

	private String cardId;

	private String email;

	private String whenchanged;

	private String status;

	private String samaccountname;

	private String userprincipalname;

	private String department;

	private String service;

	private String filiale;

	private String headquarters;

	private String permissionFlag;

	private Integer remissionCount; // 总豁免次数

	private Integer usedRemissionCount; // 使用豁免次数

	public String getUid() {
		return uid;
	}

	public void setUid(String uid) {
		this.uid = uid == null ? null : uid.trim();
	}

	public String getUname() {
		return uname;
	}

	public void setUname(String uname) {
		this.uname = uname == null ? null : uname.trim();
	}

	public String getLoginId() {
		return loginId;
	}

	public void setLoginId(String loginId) {
		this.loginId = loginId == null ? null : loginId.trim();
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password == null ? null : password.trim();
	}

	public String getMobilePhone() {
		return mobilePhone;
	}

	public void setMobilePhone(String mobilePhone) {
		this.mobilePhone = mobilePhone == null ? null : mobilePhone.trim();
	}

	public String getTelephone() {
		return telephone;
	}

	public void setTelephone(String telephone) {
		this.telephone = telephone == null ? null : telephone.trim();
	}

	public String getCardId() {
		return cardId;
	}

	public void setCardId(String cardId) {
		this.cardId = cardId == null ? null : cardId.trim();
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email == null ? null : email.trim();
	}

	public String getWhenchanged() {
		return whenchanged;
	}

	public void setWhenchanged(String whenchanged) {
		this.whenchanged = whenchanged == null ? null : whenchanged.trim();
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.status = status == null ? null : status.trim();
	}

	public String getSamaccountname() {
		return samaccountname;
	}

	public void setSamaccountname(String samaccountname) {
		this.samaccountname = samaccountname == null ? null : samaccountname.trim();
	}

	public String getUserprincipalname() {
		return userprincipalname;
	}

	public void setUserprincipalname(String userprincipalname) {
		this.userprincipalname = userprincipalname == null ? null : userprincipalname.trim();
	}

	public String getDepartment() {
		return department;
	}

	public void setDepartment(String department) {
		this.department = department == null ? null : department.trim();
	}

	public String getService() {
		return service;
	}

	public void setService(String service) {
		this.service = service == null ? null : service.trim();
	}

	public String getFiliale() {
		return filiale;
	}

	public void setFiliale(String filiale) {
		this.filiale = filiale == null ? null : filiale.trim();
	}

	public String getHeadquarters() {
		return headquarters;
	}

	public void setHeadquarters(String headquarters) {
		this.headquarters = headquarters == null ? null : headquarters.trim();
	}

	public String getPermissionFlag() {
		return permissionFlag;
	}

	public void setPermissionFlag(String permissionFlag) {
		this.permissionFlag = permissionFlag;
	}

	public Integer getRemissionCount() {
		return remissionCount;
	}

	public void setRemissionCount(Integer remissionCount) {
		this.remissionCount = remissionCount;
	}

	public Integer getUsedRemissionCount() {
		return usedRemissionCount;
	}

	public void setUsedRemissionCount(Integer usedRemissionCount) {
		this.usedRemissionCount = usedRemissionCount;
	}
}