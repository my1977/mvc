# mvc
# 单入口 index.php
# 控制器 UserController.class.php
# 模型 UserModel.class.php
# 视图 前段写得html  add.html

``` 
{
  "data" : [
  ]
}
``` 
mvc
	index.php
	controller
		UserContrller.class.php
	model
		UserModel.class.php
	view
		user
			add.html
			edit.html
			lists.html


localhost/mvc/
index.php? 

新建一个Blog控制器
	新建一个add方法      				c=Blog&a=add    
			//if (()) {

			//}     
			包含一个网页
		doadd方法					c=Blog&a=doAdd         
			接收一个内容参数
			获取一个session里的用户的id   
			add blog表 	BlogModel->
		lists方法					c=Blog&a=lists         
			直接查所有的blog记录  BlogModel->
			把用户信息拿出来      UserModel->
			包含一个网页


新建一个UserCenterController 
	login							c=UserCenter&a=login         
		include 
	dologin							c=UserCenter&a=doLogin    
		name password
		通过name 获取 userinfo   UserModel->
		对比 userinfo['password'] == password
			userinfo 加到  session

	reg								c=UserCenter&a=reg    
		include
	doreg							c=UserCenter&a=doReg    
		name age password
		add user     UserModel->
	logout							c=UserCenter&a=logout    
		unset session
