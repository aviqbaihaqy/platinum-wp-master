var tmp;
function strip(html) {
  tmp = document.createElement("DIV");
  tmp.innerHTML = html;
  console.log(tmp.innerText);
  console.log(tmp.textContent);
  
  return tmp.textContent || tmp.innerText || "";
}

var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,',
    template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
    base64 = function(s) {
      return window.btoa(unescape(encodeURIComponent(s)))
    },
    format = function(s, c) {
      return s.replace(/{(\w+)}/g, function(m, p) {
        return c[p];
      })
    }
  return function(table, name, filename) {
    if (!table.nodeType) 
      table = $('#'+table).clone();
    
      var hyperLinks = table.find('a');
    for (i = 0; i < hyperLinks.length; i++) {
           
          var sp1 = document.createElement("span");
          var sp1_content = document.createTextNode($(hyperLinks[i]).text());
          sp1.appendChild(sp1_content);
          var sp2 = hyperLinks[i];
          var parentDiv = sp2.parentNode;
          parentDiv.replaceChild(sp1, sp2);
      }

      var ctx = {
        worksheet: name || 'Worksheet',
        table: table[0].innerHTML
      }
    

    document.getElementById("export-link").href = uri + base64(format(template, ctx));
    document.getElementById("export-link").download = filename;
    document.getElementById("export-link").click();

  }
})()