// public/assets/js/customer-information.js

// Fungsi untuk menangani UI pemilihan metode pembayaran
const selectPayment = (paymentMethod) => {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    paymentMethods.forEach((element) => {
        // Reset style semua elemen
        element.parentElement.style.backgroundColor = "#F1F2F6";
        element.parentElement.style.color = "#353535";
        element.checked = false;

        // Terapkan style untuk elemen yang dipilih
        if (element.value === paymentMethod) {
            element.checked = true;
            element.parentElement.style.backgroundColor = "#FF801A";
            element.parentElement.style.color = "#FFFFFF";
        }
    });
};

// Fungsi untuk menghitung total harga dari item yang ditampilkan
function calculateTotal() {
    const cartItems = document.querySelectorAll(".cart-item");
    let total = 0;
    cartItems.forEach(cartItem => {
        const priceElement = cartItem.querySelector('p[id="price"]');
        const price = parseInt(priceElement.textContent.replace(/[^0-9]/g, ''), 10);
        const qtyElement = cartItem.querySelector('#qty');
        const qty = parseInt(qtyElement.textContent.replace(/[^0-9]/g, ''), 10);
        total += price * qty;
    });

    const totalAmountElement = document.getElementById('totalAmount');
    if (totalAmountElement) {
        totalAmountElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }
}


// Semua logika utama kita letakkan di dalam event listener ini
// agar berjalan setelah semua elemen HTML selesai dimuat.
document.addEventListener('DOMContentLoaded', function () {
    // === BAGIAN 1: MENAMPILKAN ITEM DARI LOCALSTORAGE (Kode Anda, sudah benar) ===
    const cartData = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItems = document.querySelectorAll(".cart-item");

    cartItems.forEach((item) => {
        const productId = item.dataset.id;
        const cartProduct = cartData.find((cart) => cart.id === productId);

        if (!cartProduct) {
            item.remove(); // Hapus item dari tampilan jika tidak ada di cart
        } else {
            // Update quantity dan notes
            const qtyElement = item.querySelector("#qty");
            const notesInput = item.querySelector("#notes");
            if (qtyElement) qtyElement.textContent = 'x' + cartProduct.qty;
            if (notesInput) notesInput.value = cartProduct.notes;
        }
    });
    // Hitung total harga setelah menyesuaikan item
    calculateTotal();


    // === BAGIAN 2: EVENT LISTENER UNTUK TOMBOL PEMBAYARAN (Kode Anda, sudah benar) ===
    const paymentMethodDivs = document.querySelectorAll('input[name="payment_method"]');
    paymentMethodDivs.forEach((element) => {
        // Kita gunakan parentElement karena div-nya yang di-klik
        element.parentElement.addEventListener('click', () => {
            selectPayment(element.value);
        });
    });

    
    // === BAGIAN 3: LOGIKA SUBMIT FORM (INI BAGIAN UTAMA YANG DIUBAH) ===
    const form = document.getElementById('Form');
    if (!form) return; // Keluar jika form tidak ditemukan

    form.addEventListener('submit', async function (event) {
        // Selalu cegah submit default terlebih dahulu
        event.preventDefault();

        // 1. Ambil data cart dari localStorage dan masukkan ke input tersembunyi
        const cartDataInput = document.getElementById('cart-data');
        const cartFromStorage = JSON.parse(localStorage.getItem("cart")) || [];

        if (cartFromStorage.length === 0) {
            alert('Keranjang Anda kosong!');
            return;
        }
        cartDataInput.value = JSON.stringify(cartFromStorage);

        // 2. Cek metode pembayaran yang dipilih
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) {
            alert('Silakan pilih metode pembayaran.');
            return;
        }

        // 3. Jika metode 'cash', submit form secara normal
        if (paymentMethod.value === 'cash') {
            localStorage.removeItem("cart"); // Hapus cart untuk pembayaran cash
            form.submit(); // Lanjutkan submit normal
            return;
        }

        // 4. Jika metode 'midtrans', jalankan logika Fetch API
        if (paymentMethod.value === 'midtrans') {
            const formData = new FormData(form);
            const url = form.action;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData,
                });

                const result = await response.json();

                if (!response.ok) {
                    alert(result.error || 'Terjadi kesalahan server.');
                    return;
                }

                // Ambil Snap Token dan URL redirect untuk halaman sukses
                const snapToken = result.snap_token;
                const redirectUrlSuccess = result.redirect_url_success;

                // Buka Popup Pembayaran Midtrans
                snap.pay(snapToken, {
                    onSuccess: function (result) {
                        // HAPUS CART HANYA SETELAH PEMBAYARAN SUKSES
                        localStorage.removeItem("cart");
                        alert('Pembayaran berhasil!');
                        window.location.href = redirectUrlSuccess;
                    },
                    onPending: function (result) {
                        localStorage.removeItem("cart");
                        alert('Menunggu pembayaran Anda.');
                        window.location.href = redirectUrlSuccess;
                    },
                    onError: function (result) {
                        alert('Pembayaran gagal!');
                        console.error('Payment Error:', result);
                    },
                    onClose: function () {
                        alert('Anda menutup popup pembayaran.');
                    }
                });

            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Tidak dapat terhubung ke server.');
            }
        }
    });
});