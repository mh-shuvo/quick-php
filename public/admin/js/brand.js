var brandOptions = {
    "api_endpoint": `${BASEPATH}fetch-brands`,
    "limit":10,
    "page":1,
    "pagination_target_element":document.querySelector("#pagination"),
    "render_method": (items,limit,page)=>{
        renderBrand(items,limit,page)
    },
    "render_table": document.querySelector("#brandTable")
}
fetchListData(brandOptions);

function renderBrand(Brand,limit,current_page) {
    const tableBody = document.querySelector("tbody");
    var currentRowNumber = (limit * (current_page -1 )) + 1
    tableBody.innerHTML = ""; // Clear existing data
    Brand.forEach((brand) => {
        const row = document.createElement("tr");
        var image = brand.logo;
        if(!image.startsWith("http")){
            image = `${STORAGE_BASE}/${image}`
        }
        row.innerHTML = `
            <td>${currentRowNumber}</td>
            <td><img src="${image}" style="height:100px;width:100px;" alt=""></td>
            <td>
                <p>${brand.brand_name} 
                    ${brand.is_featured ? '<span class="badge text-bg-success">Featured</span>' : ""}
                </p>
            </td>
            <td>${brand.status}</td>
            <td>
                <a href="${BASEPATH}/brand/edit/${brand.id}" class="btn btn-success btn-sm">Edit</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm brand_delete" data-id="${brand.id}">Delete</a>
            </td>
        `;
        tableBody.appendChild(row);
        currentRowNumber++;
    });
    addDeleteEventListeners(".brand_delete",`${BASEPATH}/brand/delete/:id`);
}
