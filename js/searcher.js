const searchInput = document.querySelector('#avtor_bir');
const autocompleteDropdown = document.querySelector('#myDropdown');

searchInput.addEventListener('input', function() {
	const inputValue = searchInput.value;

	if (inputValue.length > 0) {
		fetch(`search.php?nameAvtor=${inputValue}`)
			.then(response => response.json())
			.then(data => {
				autocompleteDropdown.innerHTML = '';

				data.forEach(item => {
					const autocompleteItem = document.createElement('div');
					autocompleteItem.classList.add('avtor1-item');
					autocompleteItem.textContent = item.name;

					autocompleteItem.addEventListener('click', function() {
						searchInput.value = item.name;
						autocompleteDropdown.innerHTML = '';
					});

					autocompleteDropdown.appendChild(autocompleteItem);
				});
			})
			.catch(error => console.error(error));
	} else {
		autocompleteDropdown.innerHTML = '';
	}
});

document.addEventListener('click', function(event) {
	if (!event.target.closest('.avtor1')) {
		autocompleteDropdown.innerHTML = '';
	}
});