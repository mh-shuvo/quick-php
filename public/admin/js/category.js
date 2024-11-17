function addDeleteEventListeners() {
    const categoryDeleteButtons = document.querySelectorAll(".category_delete");
    categoryDeleteButtons.forEach((button) => {
        button.addEventListener("click", function (el) {
            const isConfirm = confirm("Are you sure?");
            if (isConfirm) {
                const id = el.target.getAttribute("data-id");
                const endpoint = `${BASEPATH}/category/delete/${id}`;
                const request = new XMLHttpRequest();

                const row = el.target.closest("tr");

                request.open("GET", endpoint);
                request.onreadystatechange = function () {
                    if (request.readyState == XMLHttpRequest.DONE) {
                        if (request.status == 200) {
                            const data = JSON.parse(request.responseText);
                            if (data.status === "success") {
                                row.remove();
                                alert(data.message);
                            }
                        } else {
                            const data = JSON.parse(request.responseText);
                            alert("Error: " + data.message);
                        }
                    }
                };
                request.send();
            }
        });
    });
}

function fetchCategories(page=1){
    const limit = 10;
    const endpoint = `${BASEPATH}fetch-categories?limit=${limit}&page=${page}`

    const req = new XMLHttpRequest();
    req.open("GET",endpoint)
    req.onreadystatechange = ()=>{
        if (req.readyState === XMLHttpRequest.DONE) {
            if(req.status === 200){
                const response = JSON.parse(req.responseText);
                renderCategories(response.data,limit,page)
                renderPagination(response.pagination)
            }
        }
    }
    req.send();
}

fetchCategories();
function renderCategories(categories,limit,current_page) {
    const tableBody = document.querySelector("tbody");
    var currentRowNumber = (limit * (current_page -1 )) + 1
    tableBody.innerHTML = ""; // Clear existing data
    categories.forEach((category, index) => {
        const row = document.createElement("tr");
        var image = category.image;
        if(!image.startsWith("http")){
            image = `${STORAGE_BASE}/${image}`
        }
        row.innerHTML = `
            <td>${currentRowNumber}</td>
            <td><img src="${image}" style="height:100px;width:100px;" alt=""></td>
            <td>
                <p>${category.category_name} 
                    ${category.is_featured ? '<span class="badge text-bg-success">Featured</span>' : ""}
                </p>
            </td>
            <td>${category.status}</td>
            <td>
                <a href="${BASEPATH}/category/edit/${category.id}" class="btn btn-success btn-sm">Edit</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm category_delete" data-id="${category.id}">Delete</a>
            </td>
        `;
        tableBody.appendChild(row);
        addDeleteEventListeners();
        currentRowNumber++;
    });
}

function renderPagination(pagination,targetElement = document.querySelector("#pagination")) {
    const paginationContainer = targetElement;
    paginationContainer.innerHTML = ""; // Clear existing pagination

    for (let i = 1; i <= pagination.total_pages; i++) {
        const pageButton = document.createElement("button");
        pageButton.className = "btn btn-primary";
        pageButton.style.margin = "0px 5px 0px 0px"
        if(i == pagination.current_page){
            pageButton.setAttribute('disabled',true);
        }
        pageButton.textContent = i;
        pageButton.onclick = () => fetchCategories(i);
        paginationContainer.appendChild(pageButton);
    }
}