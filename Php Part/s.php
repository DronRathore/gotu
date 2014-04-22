<!doctype html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<script>
	function Ajax(url,method,element) {
	if(this==window)
		return new Ajax(url,method);
	else
		this.object=(window.XMLHttpRequest)?new window.XMLHttpRequest():new window.ActiveXObject("Microsoft.XMLHTTP");
		this.url=url.elements?url.target:url;
		this.d=null;
		this.object.form=null;
		this.object.errorHandler = null;
		this.object.callback=null;
		this.object.element=element?element:null;
		this.object.ajax=this;
		this.object.JSONCallback=null;
		this.method=method?method:(element?element.method:"GET");
		return this;
}
	Ajax.prototype.JSON=function(c){
		this.object.JSONCallback=c;
		this.send(this.JSONHandler);
	};
	Ajax.prototype.JSONHandler=function(xhr, form) {
		this.JSONCallback(JSON.parse(this.responseText, this.errorHandler), form);
	}
	Ajax.prototype.onError=function(callback){
		this.object.errorHandler = callback;
	}
	Ajax.prototype.data=function(raw_data){
							/*
								If it is a Form Element
							*/
							if(raw_data.elements){
								this.d="";
								this.object.form=raw_data;
								for(i=0;i<raw_data.elements.length;i++){
									if(raw_data.elements[i].type!="button"&&raw_data.elements[i].type!="reset"&&raw_data.elements[i].type!="submit")
									this.d+="&" + raw_data.elements[i].name + "=" + raw_data.elements[i].value;
								}
							}else{
								this.d="";
								for(elem in raw_data){
									this.d+="&" + elem + "=" + raw_data[elem];
								}
							}
							return this;
					};
	Ajax.prototype.send=function(callbacks){
	if (this.method != "POST")
		this.object.open(this.method,this.url+(this.d?"?"+this.d:""),true);
	else
		this.object.open(this.method,this.url,true);
		if(this.method=="POST")
		this.object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		this.object.callback=callbacks;
		this.object.onreadystatechange=this.handler;
	if (this.method != "POST")
		this.object.send();
	else	
		this.object.send(this.d);
		return this;
	}
	Ajax.prototype.getObject = function(){return this.object;}
	Ajax.prototype.handler=function(){
		if(this.readyState==4){
						if(this.status==200){
							this.callback(this,this.form);
								
						} else {
							if (this.form) 
							this.form.setAttribute("_ajax",0);
								if (!this.errorHandler) {
									if (Utils.current)
										Utils.current.release();
									if (System.state)
										System.state = 0;
									DOM._rsl();
									DOM.log("[error] XHR Failed with error code "+this.status+(this.status ==0?", i.e. No Internet Connection":", i.e. Could not reach the server" ));
							} else {
								this.errorHandler(this.status, this.form);
							}
						}
		}
	}
JSON={
	toString:function(data, character, toChar){
		while (data.indexOf(character)!=-1) {
			data=data.replace(character, toChar);
		}
		return data;
	},
	parse:function(text, errorHandler){
		try{
		if(text.length<9) {
			throw new Error();	
		}
			var data=eval(text);
			var dummyObject={};
			for(a in data) {
				dummyObject[a]=data[a];
			}
		return dummyObject;
		} catch(e){
			console.log(text);
			if (!errorHandler) {
				DOM.log("JSON parse Error");
				if (Utils.current)
					Utils.current.release();
				if (System.state)
					System.state = 0;
				DOM._rsl();
			} else {
				errorHandler();
			}
		}
	}

};
	</script>
	<script>
	var mohit="";
	var temp;
	window.loading =false;
	window.stop = false;
	function test(){
	if (!window.loading && !window.stop){
	window.loading = true;
	var a = new Ajax("./ajax.php", "GET");
	a.send(function(xhr){
		
		//document.getElementById("msgs").innerHTML = xhr.responseText;
		mohit=xhr.responseText;
		//console.log("Mohit:"+mohit);
		setGL(mohit);

		
		window.loading =false;
	});
	}
	}
	
	setInterval(test, 300);
	</script>
	</head>
<body>
	
	

</body>
</html>