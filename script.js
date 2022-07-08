let target = document.querySelector(".drop_area");
let fileInput = document.querySelector("input[type=file]");
const preview = document.querySelector(".preview");

target.addEventListener("dragover", (e) => {
    e.preventDefault();
    console.log(e);
    target.classList.add("dragging");
});

target.addEventListener("dragleave", () => {
    if (target.classList.contains("dragging")) {
        target.classList.remove("dragging");
    }
    if (target.classList.contains("dragging-error")) {
        target.classList.remove("dragging-error");
    }
});

const convertFileUnit = size => {
    size /= 1024;
    let unit = "kb"
    if (size >= 1024) {
        size = size / 1024
        unit = "mb"
    }
    return {
        size,
        unit
    };
}

const handleFileUpload = (fileInstance) => {
    const file = document.createElement("div");
    const img = document.createElement("img");
    const pdfName = document.createElement("div");
    const removeBtn = document.createElement("a");

    file.classList.add("file-list-item");

    const size = convertFileUnit(fileInstance.size);

    pdfName.innerHTML = `${fileInstance.name} | ${Math.round(size.size)}${size.unit}`;
    removeBtn.innerHTML = "remove";
    removeBtn.href = "#";

    img.src = "./images/pdf-logo.jpg";
    // file.innerHTML = "";
    file.appendChild(img);
    file.appendChild(pdfName);
    file.appendChild(removeBtn);

    preview.appendChild(file)

    removeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        file.remove();
    });
};

fileInput.addEventListener("change", (e) => {
    const files = e.target.files
    for (let i = 0; i < files.length; i++) {
        const fileExt = files[i].type;
        handleFileUpload(files[i])
        if (fileExt != "application/pdf") {
            continue;
        }
    }
});

target.addEventListener("drop", (e) => {
    e.preventDefault();
    if (target.classList.contains("dragging")) {
        target.classList.remove("dragging");
    }
    if (target.classList.contains("dragging-error")) {
        target.classList.remove("dragging-error");
    }
    const files = e.dataTransfer.files || e.target.files;
    // console.log(files.isArray());

    for (let i = 0; i < files.length; i++) {
        const fileExt = files[i].type;

        if (fileExt != "application/pdf") {
            continue;
        }

        handleFileUpload(files[i]);
    }
    //   Add dropped file into the hidden input[type=file]
    fileInput.files = files;
});


// bro where have you learnt all these knowlwedge  ??? hhhhhhhhhhh
// hhhhhhhhhhhhh
// Google :)     hhhhhhhh//??
// "When you copy & past too much, finally you learn" - Isaac Newton

// hhhhhhhhhhh   thats true