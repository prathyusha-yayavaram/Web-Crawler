<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
<tr>
<td>
    <a href="https://www.google.co.in/search?biw=1408&bih=692&noj=1&q=khazana+stores+nearby&npsic=0&rflfq=1&rldoc=1&rlha=0&rllag=13062971,80242847,2788&tbm=lcl&sa=X&ved=0ahUKEwjzjKjGz9HTAhWMQY8KHTNDD18QtgMIMw" onmouseover="previewUrl(this.href,'div1')">google</a>
</td>
<td>
    <div id="div1" style="width:400px;height:200px;border:1px solid #ddd;"></div>
</td>
</tr>
</table>

<script>
    function previewUrl(url,target){
        //use timeout coz mousehover fires several times
        clearTimeout(window.ht);
        window.ht = setTimeout(function(){
            var div = document.getElementById(target);
            div.innerHTML = '<iframe style="width:100%;height:100%;" frameborder="0" src="' + url + '" />';
        },20);      
    }   
</script>
</body>
</html>