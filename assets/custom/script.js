function DigitOnly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode;
//    alert(unicode);
    if (unicode !== 8 && unicode !== 9 && unicode !== 45){
        if (unicode < 46 || unicode > 57 || unicode === 47){
            return false;
        }
    }
}