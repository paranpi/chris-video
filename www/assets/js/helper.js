(function () {
	this.httpUtil = {
		get:function (params,callback) {
			var xhr = new XMLHttpRequest();
			xhr.open('GET', params.url, true);
			xhr.onload = function (event) {
				// Request finished. Do processing here.
			};			
			xhr.send(params.data)
		},
		post:function (params,callback) {			
			var xhr = new XMLHttpRequest();
			
			xhr.open('POST', params.url, true);
			xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');						
			xhr.onload = function () {
				if(xhr.status == 200) {
					callback(null,JSON.parse(xhr.response));					
				}else {					
					callback(JSON.parse(xhr.response));
				}
			}
			xhr.send(JSON.stringify(params.data));
		},
		put:function (params,callback) {
			var xhr = new XMLHttpRequest();
			
			xhr.open('PUT', params.url, true);
			xhr.onload = function () {
				if(xhr.status == 200) {
					callback(null,JSON.parse(xhr.response));					
				}else {					
					callback(JSON.parse(xhr.response));
				}
			}
			xhr.send(JSON.stringify(params.data));
		},
		del:function (params,callback) {
			var xhr = new XMLHttpRequest();
			
			xhr.open('DELETE', params.url, true);
			xhr.onload = function () {
				if(xhr.status == 200) {
					callback(null,JSON.parse(xhr.response));					
				}else {					
					callback(JSON.parse(xhr.response));
				}
			}
			xhr.send(null);
		}
	}
})(window);

// Inspired by http://bit.ly/juSAWl
// Augment String.prototype to allow for easier formatting.  This implementation 
// doesn't completely destroy any existing String.prototype.format functions,
// and will stringify objects/arrays.
String.prototype.format = function(i, safe, arg) {

  function format() {
    var str = this, len = arguments.length+1;

    // For each {0} {1} {n...} replace with the argument in that position.  If 
    // the argument is an object or an array it will be stringified to JSON.
    for (i=0; i < len; arg = arguments[i++]) {
      safe = typeof arg === 'object' ? JSON.stringify(arg) : arg;
      str = str.replace(RegExp('\\{'+(i-1)+'\\}', 'g'), safe);
    }
    return str;
  }

  // Save a reference of what may already exist under the property native.  
  // Allows for doing something like: if("".format.native) { /* use native */ }
  format.native = String.prototype.format;

  // Replace the prototype property
  return format;

}();
