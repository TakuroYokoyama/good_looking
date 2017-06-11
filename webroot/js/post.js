// マウスイベントを設定
document.getElementById( "target" ).addEventListener( "click", function( e ) {
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
	var offsetX = mouseX - positionX ;
	var offsetY = mouseY - positionY ;
} ) ;