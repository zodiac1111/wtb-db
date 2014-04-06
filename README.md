# 交易中心例子

# 需求

* Linux (Windows未测试)
* appache2(其他未测试)
* mysql
* php5,gettext (国际化需要)


前端:
* jquery
* jquery UI
* dataTable

# 如何部署

* 安装apache php mysql
* 复制文件到web服务器设定的目录
* 新建数据库wtb,并导入db.sql
* conf.php文件填写数据库相关信息,数据库名称暂时只能是wtb
* 启动服务器
* 浏览器中输入地址即可访问

# 添加数据

insert.php页面是添加订单信息.