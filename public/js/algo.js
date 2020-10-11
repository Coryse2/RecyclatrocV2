
(function() {
  var placesAutocomplete = places({
  appId: 'plG0191SLGW0',
	apiKey: 'b3ea3b55c8eca8802d56a9b0a958615c',
    container: document.querySelector('#city'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'city',
    aroundLatLngViaIP: false,
  });
})();
