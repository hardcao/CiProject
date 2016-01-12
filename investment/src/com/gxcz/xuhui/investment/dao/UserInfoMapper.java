package com.gxcz.xuhui.investment.dao;

import java.util.List;
import java.util.Map;

import com.gxcz.xuhui.investment.model.UserInfo;
import com.gxcz.xuhui.investment.model.dto.UserInfoDTO;

public interface UserInfoMapper {
     
    int deleteByPrimaryKey(String uid);

    int insert(UserInfo record);

    int insertSelective(UserInfo record);

    UserInfo selectByPrimaryKey(String uid);
    
    UserInfo selectByLoginId(String loginId);
 
    int updateByPrimaryKeySelective(UserInfo record);

    int updateByPrimaryKey(UserInfo record);
    
    List<UserInfoDTO> getUserList(UserInfoDTO userInfoDto);

	UserInfo selectBySAMAccountName(String sAMAccountName);
	
	List<UserInfoDTO> getUserRelateList(UserInfoDTO userInfoDto);

	UserInfo selectByUname(String uname);
	
	int updateRemissionCountByUserId(UserInfo userInfo);
    
	int updateRemissionCountBatch(List<UserInfo> useInfoList);
    
	List<UserInfo> selectRemissionUserList();
		 
    List<UserInfo> selectRemissionUserLimit(Map<String, String> map);
    
     int updateUsedRemissionCountByUserId(String string);
}
	
