package com.gxcz.xuhui_ldap.ldap.ad;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;

import javax.naming.NamingEnumeration;
import javax.naming.NamingException;
import javax.naming.directory.Attribute;
import javax.naming.directory.Attributes;
import javax.naming.directory.SearchControls;
import javax.naming.directory.SearchResult;
import javax.naming.ldap.Control;
import javax.naming.ldap.LdapContext;
import javax.naming.ldap.PagedResultsControl;
import javax.naming.ldap.PagedResultsResponseControl;

import org.apache.log4j.Logger;

import com.gxcz.xuhui_ldap.ldap.model.UserDTO;

public class Page {
	private static final Logger logger = Logger.getLogger(Page.class);
	
	ClassLoader cl = this.getClass().getClassLoader();
	
	InputStream in = cl.getResourceAsStream("com/gxcz/xuhui_ldap/ldap/"+"size.Properties");
	
	public List<UserDTO> ldapPage(LdapContext ctx, String filter, SearchControls searchControls) {
		try {
			Properties p = new Properties();
			p.load(in);
			int pageSize = Integer.parseInt(p.getProperty("pageSize"));
			byte[] cookie = null;

			// 请求分页的结果控制

			Control[] ctls = new Control[] { new PagedResultsControl(pageSize, true) };
			ctx.setRequestControls(ctls);

			// 初始化计数器的结果

			int totalResults = 0;

			// 使用过滤器搜索对象
			List<UserDTO> userlist = new ArrayList<UserDTO>();
			do {
				NamingEnumeration results = ctx.search(p.getProperty("ou"), filter.toString(), searchControls);

				// 遍历每个页面中的结果
				while (results != null && results.hasMoreElements()) {

					SearchResult sr = (SearchResult) results.next();

					String sub = sr.getName();

					// 字符串截取
					String sur = sub.replace("CN=", "");

					String sur2 = sur.replace("OU=", "");

					String[] su = sur2.split(",");

					UserDTO user = new UserDTO();
					// 放入对象

					Attributes Attrs = sr.getAttributes();
					if (Attrs != null) {
						try {
							for (NamingEnumeration ne = Attrs.getAll(); ne.hasMore();) {
								Attribute attr = (Attribute) ne.next();
								if (attr.getID().toString().equals("name")) {
									user.setName(attr.getAll().next().toString());
								} else if (attr.getID().toString().equals("whenChanged")) {
									user.setWhenChanged(attr.getAll().next().toString());
								} else if (attr.getID().toString().equals("sAMAccountName")) {
									user.setsAMAccountName(attr.getAll().next().toString());
								} else if (attr.getID().toString().equals("userPrincipalName")) {
									user.setUserPrincipalName(attr.getAll().next().toString());
								} else if (attr.getID().toString().equals("userAccountControl")) {
									user.setStatus(getStatus(attr.getAll().next().toString()));
								}
							}
						} catch (Exception e) {
							logger.error(e.getMessage());
						}
					}

					int j = su.length;
					for (int i = su.length - 1; i >= 0; i--) {
						if (i == j - 1) {
							user.setFiliale(su[i]);

						} else if (i == j - 2) {
							user.setService(su[i]);

						} else if (i == 0) {

							break;
						} else if (i == j - 3) {
							user.setDepartment(su[i]);

						} else if (i == j - 4) {
							user.setHeadquarters(su[i]);

						}
					}
					userlist.add(user);// 添加到List集合

					// 增加计数器
					totalResults++;
				}

				// 检查响应控制

				cookie = parseControls(ctx.getResponseControls());

				// 通过cookie回服务器在接下来的页面

				ctx.setRequestControls(new Control[] { new PagedResultsControl(pageSize, cookie, Control.CRITICAL) });

			} while ((cookie != null) && (cookie.length != 0));

			ctx.close();

			logger.info("Total entries: " + totalResults);
			return userlist;
		}

		catch (NamingException e) {

			logger.error("Paged Search failed." + e);
			return null;
		}

		catch (java.io.IOException e) {

			logger.error("Paged Search failed." + e);
			return null;
		}

	}

	static byte[] parseControls(Control[] controls) throws NamingException {
		byte[] cookie = null;
		if (controls != null) {
			for (int i = 0; i < controls.length; i++) {
				if (controls[i] instanceof PagedResultsResponseControl) {
					PagedResultsResponseControl prrc = 
							(PagedResultsResponseControl)controls[i];
					cookie = prrc.getCookie();
				}
			}
		}
		return (cookie == null) ? new byte[0] : cookie;
	} 
	private static String getStatus(String status){
		String result ="2";
		if("512".equals(status) || "66048".equals(status)){
			result="2";
		}
		if("514".equals(status)){
			result="1";//0-注销 

		}

		return result;
	}

}




