function addDeleteEventListeners(delete_btn_selector,api_endpoint) {
    const deleteButtons = document.querySelectorAll(delete_btn_selector);
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (el) {
            const isConfirm = confirm("Are you sure?");
            if (isConfirm) {
                const id = el.target.getAttribute("data-id");
                const endpoint = api_endpoint.replace(":id",id);
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

function fetchListData(options={
    "api_endpoint":`${BASEPATH}`,
    "limit":10,
    "page":1,
    "pagination_target_element":document.querySelector("#pagination"),
    "render_method":"render",
    "render_table": document.querySelector("table")
}){
    // console.log(options)

    const endpoint =`${options.api_endpoint}?limit=${options.limit}&page=${options.page}`

    const req = new XMLHttpRequest();
    req.open("GET",endpoint)
    req.onreadystatechange = ()=>{
        if (req.readyState === XMLHttpRequest.DONE) {
            if(req.status === 200){
                const response = JSON.parse(req.responseText);
                if((response.data).length <=0 ){
                    renderNotDataFoundRow(options)
                }else{
                    options.render_method(response.data,options.limit,options.page)
                }
                
                renderPagination(response.pagination,options)
            }
        }
    }
    req.send();
}

function renderNotDataFoundRow(options){
    const table = options.render_table
    const tr = document.createElement('tr')
    const totalColumn = (table.querySelectorAll("thead th")).length || 0;
    tr.innerHTML = `
        <td colspan=${totalColumn} style="text-align:center; padding-top: 5px; padding-bottom:5px; font-weight:bold;color:red">No Data Found</td>
    `
    table.appendChild(tr)
}


function renderPagination(pagination,options) {
    const paginationContainer = options.pagination_target_element;
    paginationContainer.innerHTML = ""; // Clear existing pagination

    for (let i = 1; i <= pagination.total_pages; i++) {
        const pageButton = document.createElement("button");
        pageButton.className = "btn btn-primary";
        pageButton.style.margin = "0px 5px 0px 0px"
        if(i == pagination.current_page){
            pageButton.setAttribute('disabled',true);
        }
        pageButton.textContent = i;
        
        var pageOptions = options;
        pageOptions.page = i;

        pageButton.onclick = () => fetchCategories(pageOptions);
        paginationContainer.appendChild(pageButton);
    }
}