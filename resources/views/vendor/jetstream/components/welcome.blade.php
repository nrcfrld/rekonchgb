<div class="p-6 bg-white border-b border-gray-200 d-flex items-center justify-between">
    <h1>Report Laporan Chargeback</h1>
    <form action="">
        <select name="year" id="year" class="form-select">
            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
            <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
        </select>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
