let content = document.querySelector('.content');
let toast = document.querySelector('.toast');


let successMessage = 'Bạn đã thêm sản phẩm thành công';
let deleteMessage = 'Bạn đã xóa sản phẩm khỏi giỏ hàng';

let bellIcon = document.querySelector('.icon');

// toast
// Hàm hiển thị thông báo Toast
function showToast(message) {
    let content = document.querySelector('.content');
    let toast = document.querySelector('.toast');
    let bellIcon = document.querySelector('.icon');

    // Xóa các thông báo cũ
    while (content.firstChild) {
        content.removeChild(content.firstChild);
    }

    // Tạo phần tử mới cho thông báo
    const title = document.createElement('div');
    title.classList.add('title');
    title.innerText = message;

    // Cập nhật icon chuông
    bellIcon.innerHTML = `<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
    width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.193-.538 1.193H5.538c-.538 0-.538-.6-.538-1.193 0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365Zm-8.134 5.368a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M8.54 17.901a3.48 3.48 0 0 0 6.92 0H8.54Z" />
</svg>`;
    bellIcon.classList.toggle('move');

    // Append các phần tử vào nội dung toast
    content.appendChild(bellIcon);
    content.appendChild(title);
    toast.classList.add('show-toast');

    // Tắt thông báo sau 2 giây
    setTimeout(() => {
        toast.classList.remove('show-toast');
        bellIcon.classList.toggle('move');
    }, 2000);
}
