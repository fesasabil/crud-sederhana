//ambil element
var keyword = document.getElementById('keyword');
var cari = document.getElementById('cari');
var container = document.getElementById('container');

//menambahkan event
keyword.addEventListener('keyup', function() {

//object ajax
var ajax = new XMLHttpRequest();

//cek ajax
ajax.onreadystatechange = function () {
    if ( ajax.readyState == 4 && ajax.status == 200) {
        container.innerHTML = ajax.responseText;
    }
}

//eksekusi ajax
ajax.open('GET', 'ajax/karyawan.php?keyword=' + keyword.value, true);
ajax.send();


});