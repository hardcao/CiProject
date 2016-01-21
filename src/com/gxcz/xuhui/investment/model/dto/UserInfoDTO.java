package com.gxcz.xuhui.investment.model.dto;

public class UserInfoDTO extends PagerDTO {
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
    
    private String permissionFlag ;
    
    private String projectId;

    private String type; //项目对应的user类型
//  1.项目跟人员基本关系 
//  2.项目对应的信息管理员
//  3.项目对应的跟投管理员'
    
    public String getType() {
		return type;
	}

	public void setType(String type) {
		this.type = type;
	}

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

	public String getProjectId() {
		return projectId;
	}

	public void setProjectId(String projectId) {
		this.projectId = projectId;
	}
    
    
}