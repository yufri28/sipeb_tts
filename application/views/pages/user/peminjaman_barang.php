<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Peminjaman Barang</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Datatables</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <input id="search-product" class="form-control search-product" placeholder="Cari barang..."
                            type="text" />
                        <div class="d-flex justify-content-start mb-2"></div>
                        <div class="border border-dark rounded-3">
                            <div class="container-fluid p-lg-2 p-4">
                                <div id="product-list" class="d-flex list-product m-lg-2 row justify-content-center">
                                    <?php foreach ($data_stok_barang as $key => $stok_barang): ?>
                                    <div class="col-6 col-lg-6">
                                        <div class="card mt-3 product-card"
                                            data-name="<?= $stok_barang['nama_jenisbarang']; ?>">
                                            <img src="<?= base_url() . 'uploads/detail_kondisi/' . $stok_barang['foto']; ?>"
                                                class="card-img-top"
                                                alt="<?= $stok_barang['kode'] . '-' . $stok_barang['nama_jenisbarang']; ?>" />
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $stok_barang['kode']; ?> -
                                                    <?= $stok_barang['nama_jenisbarang']; ?></h5>
                                                <a href="#" id="btn_id<?=$stok_barang['id_detail'];?>"
                                                    class="btn col-12 btn-primary add-to-cart"
                                                    data-id="<?= $stok_barang['id_detail']; ?>"
                                                    data-kode="<?= $stok_barang['kode']; ?>"
                                                    data-name="<?= $stok_barang['nama_jenisbarang']; ?>">
                                                    Add <?= $stok_barang['stok_terkini']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-3">
                    <form id="cart-form" action="<?=base_url('useraccess/save_add')?>" enctype="multipart/form-data"
                        method="post">
                        <div class="card-header">
                            <h4 class="card-title">Rincian</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Tanggal Peminjaman <small class="text-danger">*</small></label>
                                    <input required type="date" class="form-control" name="tanggal_pinjam" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Tanggal Pengembalian <small class="text-danger">*</small></label>
                                    <input required type="date" class="form-control" name="tanggal_kembali" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Nama Penanggung Jawab <small class="text-danger">*</small></label>
                                    <input required type="text" id="nama_penanggungjawab" class="form-control"
                                        placeholder="Nama Penanggung Jawab" name="nama_penanggungjawab" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>No HP Penanggung Jawab <small class="text-danger">*</small></label>
                                    <input required type="number" id="no_hp" class="form-control"
                                        placeholder="No HP Penanggung Jawab" name="no_hp" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Alamat Penggunaan Barang <small class="text-danger">*</small></label>
                                    <textarea required name="alamat" class="form-control" id="alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Keperluan <small class="text-danger">*</small></label>
                                    <textarea required name="keperluan" class="form-control" id="keperluan"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Foto KTP <small class="text-danger">*</small></label>
                                    <input accept=".jpg, .png, .jpeg" required type="file" id="foto_ktp"
                                        class="form-control" name="foto_ktp" />
                                </div>
                                <small><i>File yang diizinkan adalah .jpg/.png/.jpeg</i></small>
                            </div>
                            <br />
                            <div class="border border-dark rounded-3">
                                <div class="table-responsive">
                                    <table class="table align-middle custom-table m-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="hidden"></th>
                                                <th>ID Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-details">
                                            <!-- Dynamic rows will be added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <a href="<?=base_url('useraccess/peminjaman')?>" class="btn btn-outline-danger col-4">
                                    Kembali
                                </a>
                                <button id="clear-form-button" class="btn btn-outline-primary col-4" type="button">
                                    Clear Form
                                </button>
                                <button id="checkout-button" class="btn btn-outline-primary col-4" type="submit"
                                    disabled>
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const cartForm = document.getElementById('cart-form');
    const cartDetails = document.getElementById('cart-details');
    const searchProductInput = document.getElementById('search-product');
    const checkoutButton = document.getElementById('checkout-button');
    const totalAmountElement = document.getElementById(
        'total-amount'); // Ganti 'totalAmountElement' dengan 'total-amount'

    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    let formData = JSON.parse(localStorage.getItem('formData')) || {};

    const saveFormData = () => {
        const formData = {
            tanggal_pinjam: document.querySelector('input[name="tanggal_pinjam"]').value,
            tanggal_kembali: document.querySelector('input[name="tanggal_kembali"]').value,
            nama_penanggungjawab: document.getElementById('nama_penanggungjawab').value,
            no_hp: document.getElementById('no_hp').value,
            alamat: document.getElementById('alamat').value,
            keperluan: document.getElementById('keperluan').value,
            // Catatan: File (foto_ktp) tidak dapat disimpan ke localStorage karena bukan string.
            // Bisa disimpan hanya nama file jika dibutuhkan:
            foto_ktp_nama: document.getElementById('foto_ktp').files[0]?.name || null
        };

        localStorage.setItem('formData', JSON.stringify(formData));
    };

    document.getElementById('clear-form-button').addEventListener('click', function() {
        if (confirm("Yakin ingin menghapus semua isian form?")) {
            const form = document.getElementById('cart-form');
            form.reset();

            // Hapus elemen produk dinamis jika ada
            const productContainer = document.querySelector(
                '#product-container'); // sesuaikan ID/container-nya
            if (productContainer) {
                productContainer.innerHTML = '';
            }

            // Nonaktifkan tombol checkout
            document.getElementById('checkout-button').disabled = true;

            // Hapus data dari localStorage jika perlu
            localStorage.removeItem('formData');
            localStorage.removeItem('cart');
        }
    });


    const loadFormData = () => {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (!savedData) return;
        document.querySelector('input[name="tanggal_pinjam"]').value = savedData.tanggal_pinjam || '';
        document.querySelector('input[name="tanggal_kembali"]').value = savedData.tanggal_kembali || '';
        document.getElementById('nama_penanggungjawab').value = savedData.nama_penanggungjawab || '';
        document.getElementById('no_hp').value = savedData.no_hp || '';
        document.getElementById('alamat').value = savedData.alamat || '';
        document.getElementById('keperluan').value = savedData.keperluan || '';
    };


    // Loop untuk men-disable tombol berdasarkan ID di cart
    Object.keys(cart).forEach(function(id_detail) {
        const btn = document.getElementById('btn_id' + id_detail);
        if (btn) {
            btn.classList.add('btn-secondary');
            btn.classList.remove('btn-primary');
            btn.innerText = 'Added';
            btn.disabled = true;
        }
    });

    // Tambahkan event listener ke semua tombol add-to-cart
    const buttons = document.querySelectorAll('.add-to-cart');
    buttons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const kode = this.dataset.kode;
            const name = this.dataset.name;

            // Simpan ke localStorage
            cart[id] = {
                id,
                kode,
                name
            };
            localStorage.setItem('cart', JSON.stringify(cart));

            // Ubah tampilan tombol
            this.classList.add('btn-secondary');
            this.classList.remove('btn-primary');
            this.innerText = 'Added';
            this.disabled = true;
        });
    });

    const updateCartDetails = () => {
        cartDetails.innerHTML = '';
        let productCount = 0;
        let totalAmount = 0;

        for (let [productId, product] of Object.entries(cart)) {
            productCount++;

            // Disable semua tombol dengan ID spesifik
            const btns = document.querySelectorAll(`#btn_id${productId}`);
            btns.forEach(btn => btn.disabled = true);

            // Buat baris baru dalam tabel cart
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${productCount}</td>
            <td><input type="hidden" name="product_id[]" class="product-id" value="${productId}"/></td>
            <td>${product.kode}</td>
            <td>${product.name}</td>
            <td>
                <button class="btn btn-outline-danger btn-sm delete-row" data-id="${productId}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" data-bs-title="Delete">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        `;
            cartDetails.appendChild(newRow);

            // Tambah ke totalAmount jika ada properti price
            if (product.price && product.loan_amount) {
                totalAmount += product.price * product.loan_amount;
            }
        }

        // Hapus dan pasang ulang semua event listener untuk delete
        document.querySelectorAll('.delete-row').forEach(button => {
            button.removeEventListener('click',
                deleteRowHandler); // optional: jika sebelumnya pernah di-attach
            button.addEventListener('click', deleteRowHandler);
        });

        // Event handler terpisah untuk hapus
        function deleteRowHandler() {
            // const productId = this.getAttribute('data-id');
            // delete cart[productId];
            // localStorage.setItem('cart', JSON.stringify(cart));
            // updateCartDetails();
            const productId = this.getAttribute('data-id');

            // Hapus dari cart dan localStorage
            delete cart[productId];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDetails();

            // Aktifkan kembali tombol "Add" yang sesuai
            const addButton = document.querySelector(`#btn_id${productId}`);
            if (addButton) {
                addButton.classList.remove('btn-secondary');
                addButton.classList.add('btn-primary');
                addButton.textContent = 'Add';
                addButton.disabled = false;
            }
        }

        // Event handler untuk perubahan jumlah
        document.querySelectorAll('.loan-amount').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.getAttribute('data-id');
                const newAmount = parseInt(this.value) || 0;
                cart[productId].loan_amount = newAmount;
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDetails();
            });
        });

        // Update total ke elemen
        if (totalAmountElement) {
            const amountTotal = document.getElementById("amount-total");
            if (amountTotal) amountTotal.value = totalAmount;

            totalAmountElement.textContent = "Total: Rp" + totalAmount.toLocaleString('id-ID', {
                minimumFractionDigits: 0
            });
        }

        // Aktifkan atau nonaktifkan tombol checkout
        checkoutButton.disabled = productCount === 0;
    };


    const filterProducts = () => {
        const searchTerm = searchProductInput.value.trim().toLowerCase();
        document.querySelectorAll('.product-card').forEach(card => {
            const name = card.dataset.name?.toLowerCase() || '';
            const titleText = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
            // Cocokkan dengan nama atau kode di judul
            if (name.includes(searchTerm) || titleText.includes(searchTerm)) {
                // Tampilkan kolom wrapper agar layout tetap rapi
                const wrapper = card.closest('[class*="col-"]');
                if (wrapper) wrapper.style.display = '';
                else card.style.display = '';
            } else {
                const wrapper = card.closest('[class*="col-"]');
                if (wrapper) wrapper.style.display = 'none';
                else card.style.display = 'none';
            }
        });
    };


    // Panggil fungsi updateCartDetails untuk pertama kali
    loadFormData();
    updateCartDetails();
    // Tambahkan event listener untuk tombol tambah ke keranjang
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productCode = this.getAttribute('data-kode');

            if (cart[productId]) {
                cart[productId].loan_amount += 1;
            } else {
                cart[productId] = {
                    name: productName,
                    kode: productCode,
                    loan_amount: 1
                };
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDetails(); // Perbarui detail keranjang setelah ditambahkan barang
        });
    });


    // Tambahkan event listener untuk input pencarian produk
    searchProductInput.addEventListener('input', filterProducts);

    // Tambahkan event listener untuk input pada form keranjang
    cartForm.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', saveFormData);
    });
});
</script>