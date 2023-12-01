const filter = document.getElementById('filter');
const items = document.getSelectorAll('tbody tr');

filter.addEventListener("input", (e) => filterData(e.target.value));

function filterData(search) {
    items.forEach(item => {
        if (item.innerText.toLowerCase().includes(search.toLowerCase())) {
            item.classList.remove('d-none');
        } else {
            item.classList.add('d-none');
        }
    })
}