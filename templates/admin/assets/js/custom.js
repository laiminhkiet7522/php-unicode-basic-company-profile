//Delete With SweetAlert2
$(function () {
    $(document).on('click', '#delete_sweet_alert2', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

function toSlug(title) {
    let slug = title.toLowerCase(); //Chuyển thành chữ thường

    slug = slug.trim(); //Xoá khoảng trắng 2 đầu

    //lọc dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'u');
    slug = slug.replace(/đ/gi, 'd');

    //chuyển dấu cách (khoảng trắng) thành gạch ngang
    slug = slug.replace(/ /gi, '-');

    //Xoá tất cả các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    return slug;
}

let sourceTitle = document.querySelector('.slug');
let slugRender = document.querySelector('.render-slug');

let renderLink = document.querySelector('.render-link');
if (renderLink !== null) {

    //Lấy slug
    let slug = '';
    if (slugRender !== null) {
        slug = '/' + slugRender.value.trim();
    }

    renderLink.querySelector('span').innerHTML = `<a href="${rootUrl + slug}" target="_blank">${rootUrl + slug}</a>`;
}
if (sourceTitle !== null && slugRender !== null) {
    sourceTitle.addEventListener('keyup', (e) => {

        if (!sessionStorage.getItem('save_slug')) {
            let title = e.target.value;

            if (title !== null) {
                let slug = toSlug(title);

                slugRender.value = slug;
            }
        }

    });

    sourceTitle.addEventListener('change', () => {
        sessionStorage.setItem('save_slug', 1);

        let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '.html';

        renderLink.querySelector('span a').innerHTML = currentLink;
        renderLink.querySelector('span a').href = currentLink;
    });

    slugRender.addEventListener('change', (e) => {
        let slugValue = e.target.value;
        if (slugValue.trim() == '') {
            sessionStorage.removeItem('save_slug');
            let slug = toSlug(sourceTitle.value);
            e.target.value = slug;
        }

        let currentLink = rootUrl + '/' + prefixUrl + '/' + slugRender.value.trim() + '.html';

        renderLink.querySelector('span a').innerHTML = currentLink;
        renderLink.querySelector('span a').href = currentLink;
    });

    if (slugRender.value.trim() == '') {
        sessionStorage.removeItem('save_slug');
    }
}


//Xử lý ckeditor với class
let classTextarea = document.querySelectorAll('.editor');
if (classTextarea !== null) {
    classTextarea.forEach((item, index) => {
        item.id = 'editor_' + (index + 1);
        CKEDITOR.replace(item.id);
    });
}

//Xử lý mở popup ckfinder

function openCkfinder() {
    let chooseImages = document.querySelectorAll('.choose-image');
    if (chooseImages !== null) {
        chooseImages.forEach(function (item) {

            item.addEventListener('click', function () {

                let parentElementObject = this.parentElement;
                while (parentElementObject) {

                    parentElementObject = parentElementObject.parentElement;

                    if (parentElementObject.classList.contains('ckfinder-group')) {
                        break;
                    }
                }

                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            let fileUrl = evt.data.files.first().getUrl(); //Xử lý chèn link ảnh vào input

                            parentElementObject.querySelector('.image-render').value = fileUrl;
                        });
                        finder.on('file:choose:resizedImage', function (evt) {
                            let fileUrl = evt.data.resizedUrl;
                            //Xử lý chèn link ảnh vào input
                            parentElementObject.querySelector('.image-render').value = fileUrl;
                        });
                    }
                });
            });

        });
    }
}

openCkfinder();

//Xử lý thêm dữ liệu dưới dạng Repeater

const galleryItemHtml = `<div class="gallery-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row ckfinder-group">
                                        <div class="col-10">
                                            <input type="text" class="form-control image-render" name="gallery[]" placeholder="Đường dẫn ảnh..." value=""/>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i> </a>
                                </div>
                            </div>

                        </div><!--End .gallery-item-->`;

const addGalleryObject = document.querySelector('.add-gallery');
const galleryImagesObject = document.querySelector('.gallery-images');

if (addGalleryObject !== null && galleryImagesObject !== null) {
    addGalleryObject.addEventListener('click', function (e) {
        e.preventDefault();

        let galleryItemHtmlNode = new DOMParser().parseFromString(galleryItemHtml, 'text/html').querySelector('.gallery-item');

        galleryImagesObject.appendChild(galleryItemHtmlNode);

        openCkfinder();

    });

    galleryImagesObject.addEventListener('click', function (e) {
        e.preventDefault(); //Ngăn tình trạng mặc định html (Thẻ a)
        if (e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')) {

            if (confirm('Bạn có chắc chắn muốn xoá?')) {
                let galleryItem = e.target;
                while (galleryItem) {

                    galleryItem = galleryItem.parentElement;

                    if (galleryItem.classList.contains('gallery-item')) {
                        break;
                    }
                }

                if (galleryItem !== null) {
                    galleryItem.remove();
                }

            }
        }
    });
}
