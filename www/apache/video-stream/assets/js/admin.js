(function () {	
	this.addMenu = function() {		
		var input = document.getElementById('menu-value');
		var data = {
			name:input.value,
			publish:true
		}
		httpUtil.post({url:"admin/menu",data:data},function (err,response) {
			if(err) {			
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				window.location.reload(true);
			}
		});		
		
	}
	this.delMenu = function (button) {
		var td = button.parentElement;
		var tr = td.parentElement;
		var id = tr.getElementsByClassName('menu-id')[0].textContent;
		httpUtil.del({url:"admin/menu/" + id},function (err,response) {
			if(err) {			
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				window.location.reload(true);
			}
		});		
	}

	this.clickMenu = function (labelElement) {
		var td = labelElement.parentElement;
		var tr = td.parentElement;
		var input = tr.getElementsByTagName('input')[0];
		labelElement.className = "hidden";
		input.className="";
		input.focus();
	}

	this.blurMenu = function (inputElement) {
		var td = inputElement.parentElement;
		var tr = td.parentElement;
		var span = tr.getElementsByTagName('span')[0];		
		var id = tr.getElementsByClassName('menu-id')[0].textContent;
		if(span.textContent === inputElement.value){
			inputElement.className="hidden";
			span.className="";				
			return;
		}
		httpUtil.put({url:"admin/menu/"+id,data:{name:inputElement.value}},function (err,response){			
			if(err) {			
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				window.location.reload(true);
			}
		});					
	}
	
	this.changeState = function (inputElement) {
		var label = inputElement.parentElement;
		var td = label.parentElement;
		var tr = td.parentElement;
		var id = tr.getElementsByClassName('menu-id')[0].textContent;
		httpUtil.put({url:"admin/menu/"+id,data:{publish:inputElement.checked}},function (err,response){
			if(err) {
				inputElement.checked = (inputElement.checked === true ? false:true);
				return;
			}
		});		
	}
	
	this.insertSubMenu = function (buttonElement) {
		//TODO: get menuid,name;
		var path = document.getElementById("cur-path").textContent;
		var td = buttonElement.parentElement;
		var tr = td.parentElement;		
		var fileName = tr.getElementsByClassName('file-name')[0].textContent;
		var select = tr.getElementsByClassName("menu-id")[0];
		var menuId = select.options[select.selectedIndex].value;
		httpUtil.post({url:'admin/submenu',data:{name:fileName,path:path+fileName,menu_id:menuId}},function (err,response){
			if(err) {			
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				window.location.reload(true);
			}
		})		
	}

	this.delSubMenu = function (button) {
		var td = button.parentElement;
		var tr = td.parentElement;
		var id = tr.getElementsByClassName('sub-menu-id')[0].textContent;		
		httpUtil.del({url:"admin/submenu/" + id},function (err,response) {
			if(err) {			
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				window.location.reload(true);
			}
		});
	}

})()
