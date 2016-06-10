# 图书借阅管理系统	 

## 开发背景

&#160; &#160; &#160; &#160;随着科学技术的高速发展，我们步入数字化网络化时代。图书馆是学校文献信息中心，是为全校教学和科研的学术型机构，是学校信息化的重要基地。通过网络来管理图书馆，可以让图书管理更加高效，让学生借阅图书更加方便。
## 系统分析

### 需求分析

&#160; &#160; &#160; &#160;通过实际情况的调查，要求图书管理系统具有以下功能:
+ 要求系统采用B/S架构，实现人机交互。
+ 要求系统界面简单整洁易操作。
+ 要求管理员能根据图书编号、图书名称查询，添加，修改，删除图书信息并能对图书分类管理。
+ 要求借阅人能根据学号，图书编号借阅图书并展示该学号的借阅信息。
+ 要求能够根据学号、图书编号归还图书并展示该学号的借阅信息。
+ 要求能展示所有学生的图书借阅信息并能够根据图书编号、图书名称、学号、姓名进行查询。
+ 要求管理员能够根据学号，姓名查询学生基本信息，增加、修改学生信息。
+ 要求能够根据管理员编号、管理员名称查询管、添加、修改、删除管理员基本信息。
+ 要求系统设置最多借阅天数和最多借阅本数。

### 可行性分析

&#160; &#160; &#160; &#160;可行性分析的目的就是为了通过对该系统所面临的问题及周围环境导致的客观因素进行分析，来判断该系统是否具有可行性，该系统实施的计划能否执行。可行性分析应具有预见性，公正性，可靠性，科学性的特点。图书管理信息系统的可行性我们主要从技术可行性这方面来进行分析。
&#160; &#160; &#160; &#160;开发一个在线图书管理系统，设计到的技术问题就是如何实现在不刷新页面的情况下实现显示图书的信息并完成相关的借阅操作。以此提高用户体验。通过Ajax技术可以轻松实现这些功能，这位图书管理系统的开发提供了技术支撑。本项目中，Ajax的实现基于JQuery。
## 系统设计
### 系统目标
&#160; &#160; &#160; &#160;根据前面的需求分析及用户需求可知，图书管理系统属于中小型软件，在系统实施后，应达到以下目标：
+ 采用开放、动态的系统架构，加强用户与网站的动态交互性。
+ 具有空间性。被授权的用户可以在异地登录图书管理系统，无须到图书馆查阅借阅信息。
+ 操作简单方便、界面简洁美观。
+ 超期罚金自动计算，满足快速结账的需求。。
+ 用户可以查询图书及借阅信息。
+ 对用户信息进行管理。
+ 系统运行稳定、安全可靠。

### 系统预览
&#160; &#160; &#160; &#160;图书管理系统有多个页面组成，下面仅罗列几个典型页面，其他页面请访问[图书管理系统](http://115.159.148.111/library/) 。登录界面如下图所示，该页面用于管理员以及用户登录。可根据身份自动跳转至对应页面。对于用户，可实现图书馆图书信息查询、个人借阅情况查询以及个人信息维护。管理员维护如下面图所示，该页面主要用于管理员进行各项操作，完成图书信息维护、借阅信息维护、罚金处理以及用户信息维护。

### 测试环境
1. 服务器端
	+ 操作系统：Windows Server 2008
	+ 服务器：Apache 2.2
	+ PHP软件：PHP 5.6
	+ 数据库：MySQL
	+ 前端框架：Bootstrap 3.3.5、jQuery 1.11.3、Datatables 1.10.8
	+ 开发工具：Sublime Text 3
2. 客户端
	+ 浏览器：Firefox、Google Chrome以及IE6.0及以上版本。
	+ 分辨率：最佳效果1024*768像素
3. 测试信息

		+测试网址：http://115.159.148.111/library/
		+ 管理员用户名：10000
		+ 管理员密码：admin
		+ 学生用户名：201437003
		+ 学生密码：123456
		
### 文件夹组织结构
 
+ admin身份为管理员相关的前端界面
+ conn.php 用mysqli封装用于连接数据库的conn类
+ index.php网站入口，登录界面
+ js 存放与各个页面相关用到ajax技术的js文件夹
+ login登录文件相关文件夹
+ plugins 用于存放bootstrap框架、jQuery框架的css、js文件
+ student身份为用户相关的前端界面

## 数据库设计
### 数据库概念设计

+ 人员实体包括编号、姓名、当前借阅书目、密码、所属部门
+ 部门实体包括部门名称、最大可借书数量、最大借阅天数。
+ 图书实体包含ISBN号，书籍名，作者，馆藏量，当前数量，书籍类型编号，价格，简介。 
+ 图书类型实体包含类型编号以及类型名称。
+ 借阅实体包含借阅编号，ISBN,用户编号，借阅日期，应还日期。
 
4.1.6归还实体
+ 归还实体包括归还编号、ISBN、用户编号、实际归还日期、罚金。
 
###4.3 外模式设计

ls_book_all(书籍全部信息表)
	CREATE VIEW ls_book_all AS
	SELECT book.ISBN,bname,bauthor,binventory,date,btype,bprice,bnum FROM book,bookinfo,type WHERE book.ISBN=bookinfo.ISBN AND book.typeid=type.typeid
 
ls_borrow_date (书籍借阅并计算超时日期)
	CREATE VIEW ls_borrow_date AS
	SELECT bid,book.ISBN,bname,bauthor,bprice,reader.rno,rname,borrowdate AS borrowdate,enddate AS returndate,IF(datediff(curdate(),enddate)<0,0,datediff(curdate(),enddate)) AS timeout FROM book,borrow,reader WHERE book.ISBN=borrow.ISBN AND borrow.rno=reader.rno;

ls_reader_department(读者和部门表)
 
ls_return_date(计算理论上应该归还日期和罚金的归还表)
	CREATE VIEW ls_return_date AS
	SELECT bid,book.ISBN,bname,bauthor,bprice,reader.rno,rname,borrowdate AS borrowdate,enddate AS returndate,IF(datediff(curdate(),enddate)<0,0,datediff(curdate(),enddate))*0.01 AS fine FROM book,borrow,reader WHERE book.ISBN=borrow.ISBN AND borrow.rno=reader.rno;
（罚金按照超时时长天数*0.01,即超时一天一分钱）
 
ls_return_all(实际归还信息表)
	CREATE VIEW ls_return_all AS
	SELECT book.ISBN,bname,bauthor,bprice,reader.rno,rname,rdept,returndate,fine FROM book,reader,returnd WHERE returnd.ISBN=book.ISBN AND returnd.rno=reader.rno
 
 
###前端首页技术分析
&#160; &#160; &#160; &#160;在本项目中，PHP连接MySQL数据库主要是通过主页目录下的conn类，是基于mysqli封装的。封装后可使读写数据库更为方便，其中构造函数的作用是初始化mysqli类，并对数据库进行连接。析构函数的作用主要是释放连接数据库的句柄并关闭数据库，程序代码如下：
	<?php
	class conn {
		private $mysqli;
		private $result;
		public $sql;
		function __construct($sql) {
			$this->sql=$sql;
			$this->connect();
		}
		function connect() {
			$this->mysqli=new mysqli("localhost","root","Wsz960402","libsystem");
			if(mysqli_connect_errno()) {
				die("Can not connect to mysql server");
			}
		}
		function fetch_res() {	
			$result=$this->mysqli->query($this->sql);
			while($row = $result->fetch_assoc()){
	            $res_array[] = $row;
	         }
	         return $res_array;
		}
		function execute_sql() {
			$x=$this->mysqli->query($this->sql);
			return $x;
		}
		function setsql($value) {
			$this->sql=$value;
		}
		function __destruct() {
			if(!empty($result)) {
				$result->free();
			}
			$this->mysqli->close();
		}
	}
	?>

