//Replace by PHP ???
// 漢字
var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");

if(!reg.test(plateNumber.charAt(0))){
    alert("請輸入首位漢字");
}