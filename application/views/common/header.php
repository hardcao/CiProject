    <div id="header">
        <div class="g-wrap">
            <a id="logo" href="<?php echo site_url();?>"></a>
            <ul id="nav">
                <li class="n1"><a href="<?php echo site_url();?>"><span>首页</span><span class="bkg"></span></a></li>
                <li class="n2 more"><a href="<?php echo site_url().'home/index/projectList#1';?>"><span>跟投项目信息</span><span class="bkg"></span></a></li>
                <li class="n3 more"><a href="<?php echo site_url().'home/index/personalCenter#2';?>"><span>个人中心</span></span><span class="bkg"></span></a></li>
                <li class="n4 "><a href="<?php echo site_url().'home/index/followRules#3';?>"><span>跟投制度</span><span class="bkg"></span></a></li>
                <li class="n5 "><a href="<?php echo site_url().'home/index/helpCenter#4';?>"><span>帮助中心</span><span class="bkg"></span></a></li>
                <li class="n5 "><a href="<?php echo site_url().'back';?>"><span>后台管理</span><span class="bkg"></span></a></li>
            </ul>

            <div id="shop">
                <a class="btn-lang tmp-unselect" href="javascript:void(0);">登录</a>
                <!--a href="javascript:void(0);" class="btn-search"></a-->
            </div>
        </div>
    </div>
    
    <div id="content">
        <div id="subNav">
            <div class="g-wrap">
                <div class="item about">
                    <a href="<?php echo site_url().'home/index/projectList?query=0';?>">项目信息<span></a>
                    <a href="<?php echo site_url().'home/index/newsList#1';?>">动态新闻<span></a>
                </div>
                <div class="item news">
                    <a href="<?php echo site_url().'home/index/projectList?query=1';?>">我要认购<span></a>
                    <a href="<?php echo site_url().'home/index/projectList?query=2';?>">未完成认购<span></a>
                    <a href="<?php echo site_url().'home/index/completed#2';?>">已完成认购<span></a>
                    <a href="<?php echo site_url().'home/index/payInDetail#2';?>">缴款确认<span></a>
                    <a href="<?php echo site_url().'home/index/bonusDetail#2';?>">分红明细<span></a>
                    <a href="<?php echo site_url().'home/index/personalInfo#2';?>">个人信息<span></a>
                </div>
                <div class="item search">
                    <input id='searchbox' type="text" placeholder="请输入关键词" />
                </div>
                <!--div id="language-box" class="item langs">
                    <a id="on" href="../">中文简体</a>
                    <a href="/big5">中文繁体</a>
                    <a href="/en">EN</a>
                </div-->
            </div>
        </div>
        <div style="height:67px; width:100%">
        </div>
    </div>


