document.getElementById('button-filter-by-name').addEventListener("click", () => {
    
    let nameFilter = document.getElementById('input-filter-by-name').value;

    if (nameFilter.trim() != '')
        window.location = `http://${window.location.host}/application/filter/${nameFilter}`;
})