window.Admin = (function (Admin) {
	Admin.validation = function() {
		var rssKeyword = document.getElementById('rssKeyword').value;
		if(rssKeyword === '') {
			alert('검색어를 입력 해주세요.');
			return false;
		}
		var destination = document.getElementById("destination").value;
		if(destination === '') {
			alert('다운로드 경로를 선택 해주세요.')
			return false;
		}
		return true;
	}
	Admin.delDownload = function (evt,id) {
		var button = evt;
		httpUtil.del({url:"admin/downloadList/" + id},function (err,response) {
			if(err) {
				alert(JSON.stringify(err));
				return;
			}
			if(response.status == "SUCCESS") {
				var tbody = button.parentNode.parentNode.parentNode;
				var tr = button.parentNode.parentNode;
				tbody.removeChild(tr);
			}
		});
	}
	return Admin;
})(window.Admin || {})
