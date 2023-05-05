var searchItems = document.querySelector('#search-item'),
    items = document.querySelectorAll('.search-product'),
    itemsData = document.querySelectorAll('.item'),
    searchVal;

searchItems.addEventListener('keyup', function() {
  searchVal = this.value.toLowerCase();
  
  for (var i = 0; i < items.length; i++) {
    if (!searchVal || itemsData[i].textContent.toLowerCase().indexOf(searchVal) > -1) {
      items[i].style['display'] = 'block';
    }
    else {
      items[i].style['display'] = 'none';
    }
  }
});