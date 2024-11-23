var categoryOptions = {
    "api_endpoint": `${BASEPATH}fetch-categories`,
    "limit":10,
    "page":1,
    "pagination_target_element":document.querySelector("#pagination"),
    "render_method": (items,limit,page)=>{
        renderCategories(items,limit,page)
    }
}
fetchListData(categoryOptions);

function renderCategories(categories,limit,current_page) {
    const tableBody = document.querySelector("tbody");
    var currentRowNumber = (limit * (current_page -1 )) + 1
    tableBody.innerHTML = ""; // Clear existing data
    categories.forEach((category) => {
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
        currentRowNumber++;
    });
    addDeleteEventListeners(".category_delete",`${BASEPATH}/category/delete/:id`);
}
