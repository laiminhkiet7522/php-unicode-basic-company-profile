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
  slug = slug.trim(); //Xóa khoảng trắng 2 đầu

  //Lọc dấu
  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
  slug = slug.replace(/đ/gi, 'd');

  //Chuyển dấu cách (khoảng trắng) thành gạch ngang
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