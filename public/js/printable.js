function printDiv() {
  $("body").addClass('noPrint')
  $("#printableSection").addClass('printableSection--print')
  window.print()
  $("#printableSection").removeClass('printableSection--print')
  $("body").removeClass('noPrint')
}