var offsetX = -1;
var offsetY = -1;

//マウスイベントを設定
document.getElementById("target").addEventListener("click", function(e) {
	// マウス位置を取得する
	var mouseX = e.pageX ;	// X座標
	var mouseY = e.pageY ;	// Y座標

	// 要素の位置を取得
	var element = document.getElementById( "target" ) ;
	var rect = element.getBoundingClientRect() ;

	// 要素の位置座標を計算
	var positionX = rect.left + window.pageXOffset ;	// 要素のX座標
	var positionY = rect.top + window.pageYOffset ;	// 要素のY座標

	// 要素の左上からの距離を計算
	offsetX = mouseX - positionX ;
	offsetY = mouseY - positionY ;

	console.log(offsetX);
	console.log(offsetY);
	$myIMG = document.getElementById("myIMG")
	$myIMG.style.left = (mouseX - 9) + 'px';
	$myIMG.style.top = (mouseY - 7) + 'px';
	document.getElementById("roc_x").value = Math.round(offsetX - 9);
	document.getElementById("roc_y").value = Math.round(offsetY - 7);
	console.log("roc_x"+document.getElementById("roc_x").value);
	console.log("roc_y"+document.getElementById("roc_y").value);
} ) ;

function postValue() {
	document.getElementById("myIMG").style.left;
	document.getElementById("myIMG").style.top;
}