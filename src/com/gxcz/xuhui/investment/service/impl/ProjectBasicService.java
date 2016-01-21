package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.gxcz.xuhui.investment.dao.ProjectBasicInfoMapper;
import com.gxcz.xuhui.investment.model.ProjectBasicInfo;
import com.gxcz.xuhui.investment.model.dto.ProjectBasicInfoDTO;

@Service("projectBasicService")
public class ProjectBasicService implements IProjectBasicService {
	ProjectBasicInfoMapper projectBasicInfoMapper=null;
	@Override
	public int deleteByPrimaryKey(String projectId) {
		return projectBasicInfoMapper.deleteByPrimaryKey(projectId);
	}

	@Override
	public int insert(ProjectBasicInfo record) {
		return projectBasicInfoMapper.insert(record);
	}

	@Override
	public int insertSelective(ProjectBasicInfo record) {
		return projectBasicInfoMapper.insertSelective(record);
	}

	@Override
	public ProjectBasicInfo selectByPrimaryKey(String projectId) {
		return projectBasicInfoMapper.selectByPrimaryKey(projectId);
	}

	@Override
	public int updateByPrimaryKeySelective(ProjectBasicInfo record) {
		return projectBasicInfoMapper.updateByPrimaryKeySelective(record);
	}

	@Override
	public int updateByPrimaryKey(ProjectBasicInfo record) {
		return projectBasicInfoMapper.updateByPrimaryKey(record);
	}

	@Override
	public List<ProjectBasicInfoDTO> getProjectList(ProjectBasicInfoDTO projectBasicInfoDTO) {
		return projectBasicInfoMapper.getProjectList(projectBasicInfoDTO);
	}

	@Override
	public String fetchPorjectSubscribeProtocalList(String projectId) throws Exception {
		return projectBasicInfoMapper.fetchPorjectSubscribeProtocalList(projectId);
	}

	public ProjectBasicInfoMapper getProjectBasicInfoMapper() {
		return projectBasicInfoMapper;
	}
	@Autowired
	public void setProjectBasicInfoMapper(ProjectBasicInfoMapper projectBasicInfoMapper) {
		this.projectBasicInfoMapper = projectBasicInfoMapper;
	}
	
}
