<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Penjualan</title>
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

    <form action="{{ route('sale') }}" method="POST">
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