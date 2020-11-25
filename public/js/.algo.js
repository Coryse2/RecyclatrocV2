

/* Algolia Places API*/
(function() {
  var placesAutocomplete = places({
  /* Identification elements,  necessary to call the API*/
  appId: 'plG0191SLGW0',
  apiKey: 'b3ea3b55c8eca8802d56a9b0a958615c',
   /* Select the element tagged with the id : city*/
    container: document.querySelector('#city'),
    templates: {
      value: function(suggestion) {
    /* Suggest cities names to the user while he types its city name*/
        return suggestion.name;
      }
    }
  }).configure({
    /* Ask Algolia to find the city but it's possible to call the country for eg*/
    type: 'city',
    /* Ask Algolia to limit the call to the country France*/
    countries: ['fr'],
    aroundLatLngViaIP: false,
  });
})();

(function() {
  var placesAutocomplete = places({
  appId: 'plG0191SLGW0',
	apiKey: 'b3ea3b55c8eca8802d56a9b0a958615c',
    container: document.querySelector('#city2'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'city',
    countries: ['fr'],
    aroundLatLngViaIP: false,
  });
})();
