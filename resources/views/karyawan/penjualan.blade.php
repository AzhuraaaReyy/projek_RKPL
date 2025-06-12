<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h1>Form Penjualan</h1>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="/karyawan-formcustomers" class="btn btn-sm btn-primary">
        <i class="fas fa-plus"></i> Tambah customer
    </a>

    <hr>

    <form action="{{ route('karyawan.sale') }}" method="POST">
        @csrf

        <div>
            <label for="sale_date">Tanggal Penjualan:</label>
            <input type="date" name="sale_date" value="{{ old('sale_date') }}" required />
        </div>

        <div>
            <label for="customer_id">Pilih Customer:</label>
            <select name="customer_id" required>
                <option value="">-- Pilih --</option>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
        </div>

        <hr />

        <h3>Produk yang Dibeli</h3>
        <table id="items-table" border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Deskripsi Produk</th>
                    <th>Quantity</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="product_type_id[]" class="product-type" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($producType as $type)
                            <option value="{{ $type->id }}" data-name="{{ $type->name }}"
                                data-description="{{ $type->description }}">
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="product_description[]" readonly required /></td>
                    <td><input type="number" name="quantity[]" class="qty" value="1" min="1" required /></td>
                    <td><input type="number" name="unit_price[]" class="price" value="0" min="0" required /></td>
                    <td class="subtotal">0.00</td>
                    <td><button type="button" onclick="removeRow(this)">Hapus</button></td>

                    <!-- Input hidden untuk nama produk -->
                    <input type="hidden" name="product_name[]" class="product-name" />
                </tr>
            </tbody>
        </table>

        <button type="button" onclick="addRow()">+ Tambah Produk</button>

        <hr />

        <div>
            <label for="payment_method">Metode Pembayaran:</label>
            <select name="payment_method" required>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>

        <div>
            <label for="payment_status">Status Pembayaran:</label>
            <select name="payment_status" required>
                <option value="paid">Lunas</option>
                <option value="pending">Pending</option>
            </select>
        </div>

        <div>
            <label for="notes">Catatan:</label>
            <textarea name="notes" required>{{ old('notes') }}</textarea>
        </div>

        <button type="submit">Simpan Penjualan</button>
    </form>
    <br>
    <hr>
    <br>
    <h1>Laporan Penjualan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Barang Yang di Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal Penjualan</th>
                    <th>Catatan</th>
                    <th>Nama Kasir</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $index => $sale)
                <tr>
                    <td class="text-center">{{ $sales->firstItem() + $index }}</td>

                    <td class="text-center">{{ $sale->customer->name ?? '-' }}</td>
                    <td>
                        <ul class="list-unstyled mb-0">
                            @foreach ($sale->saleItems as $item)
                            <li>{{ $item->productType->name ?? 'Produk tidak ditemukan' }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>

                    <td class="text-end">Rp{{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $sale->notes ?? '-' }}</td>
                    <td class="text-center">{{ $sale->creator->name ?? '-' }}</td>
                    <td class="text-center text-capitalize">{{ $sale->payment_method }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $sale->payment_status == 'paid' ? 'success' : ($sale->payment_status == 'pending' ? 'warning' : 'danger') }}">
                            {{ $sale->payment_status }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-{{ $sale->payment_status == 'paid' ? 'success' : ($sale->payment_status == 'pending' ? 'warning' : 'danger') }}">
                            {{ $sale->payment_status }}
                        </span>

                        @if ($sale->payment_status == 'pending')
                        <form action="{{ route('karyawan.update-status', $sale->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Tandai sebagai lunas?')">
                                ✅
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <div class="alert alert-warning m-0" role="alert">
                            Data tidak dapat ditemukan.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $sales->links() }}
        </div>

    </div>
    <script>
        function addRow() {
            const template = document.querySelector('#items-table tbody tr');
            const clone = template.cloneNode(true);

            // Reset semua input di baris baru
            clone.querySelectorAll('input').forEach(input => {
                if (input.type === 'hidden') {
                    input.value = '';
                } else if (input.type === 'number') {
                    input.value = input.classList.contains('qty') ? 1 : 0;
                } else {
                    input.value = '';
                }
            });

            clone.querySelector('.product-type').selectedIndex = 0;
            clone.querySelector('.subtotal').textContent = '0.00';

            document.querySelector('#items-table tbody').appendChild(clone);

            attachEventListeners(clone);
        }

        function removeRow(button) {
            const rows = document.querySelectorAll('#items-table tbody tr');
            if (rows.length > 1) {
                button.closest('tr').remove();
                updateSubtotals();
            } else {
                alert('Minimal 1 produk harus ada.');
            }
        }

        function updateSubtotals() {
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty').value) || 0;
                const price = parseFloat(row.querySelector('.price').value) || 0;
                const subtotal = qty * price;
                row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
            });
        }

        function attachEventListeners(row) {
            row.querySelector('.qty').addEventListener('input', updateSubtotals);
            row.querySelector('.price').addEventListener('input', updateSubtotals);

            row.querySelector('.product-type').addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const description = selected.getAttribute('data-description') || '';
                const name = selected.getAttribute('data-name') || '';

                const descInput = row.querySelector('input[name="product_description[]"]');
                if (descInput) {
                    descInput.value = description;
                }

                const nameInput = row.querySelector('input[name="product_name[]"]');
                if (nameInput) {
                    nameInput.value = name;
                }

                updateSubtotals();
            });
        }

        window.onload = function() {
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                attachEventListeners(row);
            });
            updateSubtotals();
        };
    </script>

</body>

</html>