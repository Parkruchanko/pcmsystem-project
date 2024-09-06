@extends('master')
@section('title', 'Procurement System')

@section('info')
    <style>
        .button-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
            /* ระยะห่างระหว่างปุ่ม */
        }

        .card-header {
            color: #ff2f00;
            /* เปลี่ยนสีข้อความ */
            
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h2 class="card-header ">เอกสารจัดซื้อจัดจ้างวงเงินเกิน 1 แสน</h2>
            <form action="{{ empty($info->id) ? url('/page') : url('/page/' . $info->id) }}" method="post">
                @if (!empty($info->id))
                    @method('put')
                @endif

                @csrf
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="methode_name" class="form-label">ประเภท</label>
                            <select class="form-control" id="methode_name" name="methode_name" required>
                                <option value="" disabled selected>เลือกประเภท</option>
                                <option value="จัดซื้อ" {{ old('methode_name', $info->methode_name ?? '') == 'จัดซื้อ' ? 'selected' : '' }}>จัดซื้อ</option>
                                <option value="จัดจ้าง" {{ old('methode_name', $info->methode_name ?? '') == 'จัดจ้าง' ? 'selected' : '' }}>จัดจ้าง</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">วันที่</label>
                            <input type="date" class="form-control" id="date" name="date" required
                                value="{{ old('date', $info->date instanceof \Carbon\Carbon ? $info->date->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="reason_description" class="form-label">เหตุผล</label>
                        <textarea class="form-control" id="reason_description" name="reason_description" rows="3"
                            placeholder="เหตุผลในการจัดซื้อจัดจ้าง" required>{{ old('reason_description', $info->reason_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="office_name" class="form-label">คณะ</label>
                        <input type="text" class="form-control" id="office_name" name="office_name" placeholder="คณะ"
                            required value="{{ old('office_name', $info->office_name ?? '') }}">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="attachdorder" class="form-label">เอกต้องทำถึง</label>
                            <input type="text" class="form-control" id="attachdorder" name="attachdorder"
                                placeholder="เอกต้องทำถึง" required
                                value="{{ old('attachdorder', $info->attachdorder ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="attachdorder_date" class="form-label">เอกต้องทำถึงวันที่</label>
                            <input type="date" class="form-control" id="attachdorder_date" name="attachdorder_date"
                                required
                                value="{{ old('attachdorder_date', $info->attachdorder_date instanceof \Carbon\Carbon ? $info->attachdorder_date->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="devilvery_time" class="form-label">ระยะเวลาแล้วเสร็จ</label>
                        <input type="text" class="form-control" id="devilvery_time" name="devilvery_time"
                            placeholder="ระยะเวลาแล้วเสร็จ" required
                            value="{{ old('devilvery_time', $info->devilvery_time ?? '') }}">
                    </div>

                    <!-- Products Section -->
                    <div class="mb-3">
                        <h4>ผลิตภัณฑ์</h4>
                        <div id="products-container">
                            @foreach ($info->products as $product)
                                <div class="product-entry mb-3">
                                    <input type="hidden" name="products[{{ $loop->index }}][id]"
                                        value="{{ $product->id }}">
                                    <div class="mb-2">
                                        <label for="products[{{ $loop->index }}][product_name]"
                                            class="form-label">ชื่อผลิตภัณฑ์</label>
                                        <input type="text" class="form-control"
                                            id="products[{{ $loop->index }}][product_name]"
                                            name="products[{{ $loop->index }}][product_name]" placeholder="ชื่อผลิตภัณฑ์"
                                            value="{{ old('products.' . $loop->index . '.product_name', $product->product_name) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="products[{{ $loop->index }}][quantity]"
                                            class="form-label">จำนวน</label>
                                        <input type="number" class="form-control"
                                            id="products[{{ $loop->index }}][quantity]"
                                            name="products[{{ $loop->index }}][quantity]" placeholder="จำนวน"
                                            value="{{ old('products.' . $loop->index . '.quantity', $product->quantity) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="products[{{ $loop->index }}][product_price]"
                                            class="form-label">ราคาผลิตภัณฑ์</label>
                                        <input type="text" class="form-control"
                                            id="products[{{ $loop->index }}][product_price]"
                                            name="products[{{ $loop->index }}][product_price]" placeholder="ราคาผลิตภัณฑ์"
                                            value="{{ old('products.' . $loop->index . '.product_price', $product->product_price) }}">
                                    </div>
                                </div>
                            @endforeach
                            <!-- ฟอร์มสำหรับการเพิ่มผลิตภัณฑ์ -->
                            @if (!isset($info->id))
                                <div class="product-entry mb-3 d-flex">
                                    <div class="flex-grow-1 mb-2 me-2">
                                        <label for="products[${index}][product_name]"
                                            class="form-label">ชื่อผลิตภัณฑ์</label>
                                        <input type="text" class="form-control" id="products[${index}][product_name]"
                                            name="products[${index}][product_name]" placeholder="ชื่อผลิตภัณฑ์">
                                    </div>
                                    <div class="mb-2 me-2" style="flex-basis: 150px;">
                                        <label for="products[${index}][quantity]" class="form-label">จำนวน</label>
                                        <input type="number" class="form-control" id="products[${index}][quantity]"
                                            name="products[${index}][quantity]" placeholder="จำนวน">
                                    </div>
                                    <div class="mb-2" style="flex-basis: 150px;">
                                        <label for="products[${index}][product_price]"
                                            class="form-label">ราคาผลิตภัณฑ์</label>
                                        <input type="text" class="form-control" id="products[${index}][product_price]"
                                            name="products[${index}][product_price]" placeholder="ราคาผลิตภัณฑ์">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addProduct()">เพิ่มผลิตภัณฑ์</button>
                    </div>

                    <!-- Sellers Section -->
                    <div class="mb-3">
                        <h4>ผู้ขาย</h4>
                        <div id="sellers-container">
                            @foreach ($info->sellers as $seller)
                                <div class="seller-entry mb-3">
                                    <input type="hidden" name="sellers[{{ $loop->index }}][id]"
                                        value="{{ $seller->id }}">
                                    <div class="mb-2">
                                        <label for="sellers[{{ $loop->index }}][seller_name]"
                                            class="form-label">ชื่อผู้ขาย</label>
                                        <input type="text" class="form-control"
                                            id="sellers[{{ $loop->index }}][seller_name]"
                                            name="sellers[{{ $loop->index }}][seller_name]" placeholder="ชื่อผู้ขาย"
                                            value="{{ old('sellers.' . $loop->index . '.seller_name', $seller->seller_name) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[{{ $loop->index }}][address]"
                                            class="form-label">ที่อยู่</label>
                                        <input type="text" class="form-control"
                                            id="sellers[{{ $loop->index }}][address]"
                                            name="sellers[{{ $loop->index }}][address]" placeholder="ที่อยู่"
                                            value="{{ old('sellers.' . $loop->index . '.address', $seller->address) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[{{ $loop->index }}][taxpayer_number]"
                                            class="form-label">หมายเลขผู้เสียภาษี</label>
                                        <input type="text" class="form-control"
                                            id="sellers[{{ $loop->index }}][taxpayer_number]"
                                            name="sellers[{{ $loop->index }}][taxpayer_number]"
                                            placeholder="หมายเลขผู้เสียภาษี"
                                            value="{{ old('sellers.' . $loop->index . '.taxpayer_number', $seller->taxpayer_number) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[{{ $loop->index }}][reference_documents]"
                                            class="form-label">เอกสารอ้างอิง</label>
                                        <input type="text" class="form-control"
                                            id="sellers[{{ $loop->index }}][reference_documents]"
                                            name="sellers[{{ $loop->index }}][reference_documents]"
                                            placeholder="เอกสารอ้างอิง"
                                            value="{{ old('sellers.' . $loop->index . '.reference_documents', $seller->reference_documents) }}">
                                    </div>
                                </div>
                            @endforeach
                            <!-- ฟอร์มสำหรับการเพิ่มผู้ขายใหม่ -->
                            @if (!isset($info->id))
                                <div class="seller-entry mb-3">
                                    <input type="hidden" name="sellers[${index}][id]" value="">
                                    <div class="mb-2">
                                        <label for="sellers[${index}][seller_name]" class="form-label">ชื่อผู้ขาย</label>
                                        <input type="text" class="form-control" id="sellers[${index}][seller_name]"
                                            name="sellers[${index}][seller_name]" placeholder="ชื่อผู้ขาย">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[${index}][address]" class="form-label">ที่อยู่</label>
                                        <input type="text" class="form-control" id="sellers[${index}][address]"
                                            name="sellers[${index}][address]" placeholder="ที่อยู่">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[${index}][taxpayer_number]"
                                            class="form-label">หมายเลขผู้เสียภาษี</label>
                                        <input type="text" class="form-control"
                                            id="sellers[${index}][taxpayer_number]"
                                            name="sellers[${index}][taxpayer_number]" placeholder="หมายเลขผู้เสียภาษี">
                                    </div>
                                    <div class="mb-2">
                                        <label for="sellers[${index}][reference_documents]"
                                            class="form-label">เอกสารอ้างอิง</label>
                                        <input type="text" class="form-control"
                                            id="sellers[${index}][reference_documents]"
                                            name="sellers[${index}][reference_documents]" placeholder="เอกสารอ้างอิง">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Committee Members Section -->
                    <div class="mb-3">
                        <h4>สมาชิกคณะกรรมการ</h4>
                        <div id="committee-container">
                            @foreach ($info->committeemembers as $committee_member)
                                <div class="committee-member-entry mb-3">
                                    <input type="hidden" name="committeemembers[{{ $loop->index }}][id]"
                                        value="{{ $committee_member->id }}">
                                    <div class="mb-2">
                                        <label for="committeemembers[{{ $loop->index }}][member_name]"
                                            class="form-label">ชื่อสมาชิก</label>
                                        <input type="text" class="form-control"
                                            id="committeemembers[{{ $loop->index }}][member_name]"
                                            name="committeemembers[{{ $loop->index }}][member_name]"
                                            placeholder="ชื่อสมาชิก"
                                            value="{{ old('committeemembers.' . $loop->index . '.member_name', $committee_member->member_name) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="committeemembers[{{ $loop->index }}][member_position]"
                                            class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                            id="committeemembers[{{ $loop->index }}][member_position]"
                                            name="committeemembers[{{ $loop->index }}][member_position]"
                                            placeholder="ตำแหน่ง"
                                            value="{{ old('committeemembers.' . $loop->index . '.member_position', $committee_member->member_position) }}">
                                    </div>
                                </div>
                            @endforeach

                            <!-- ฟอร์มสำหรับการเพิ่มสมาชิกคณะกรรมการใหม่ -->
                            @if (!isset($info->id))
                                <div class="committee-member-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="committeemembers[${index}][member_name]"
                                            class="form-label">ชื่อสมาชิก</label>
                                        <input type="text" class="form-control"
                                            id="committeemembers[${index}][member_name]"
                                            name="committeemembers[${index}][member_name]" placeholder="ชื่อสมาชิก">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="committeemembers[${index}][member_position]"
                                            class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                            id="committeemembers[${index}][member_position]"
                                            name="committeemembers[${index}][member_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Bidders Section -->
                    <div class="mb-3">
                        <h4>ผู้เสนอราคา</h4>
                        <div id="bidders-container">
                            @foreach ($info->bidders as $bidder)
                                <div class="bidder-entry mb-3">
                                    <input type="hidden" name="bidders[{{ $loop->index }}][id]"
                                        value="{{ $bidder->id }}">
                                    <div class="mb-2">
                                        <label for="bidders[{{ $loop->index }}][bidder_name]"
                                            class="form-label">ชื่อผู้เสนอราคา</label>
                                        <input type="text" class="form-control"
                                            id="bidders[{{ $loop->index }}][bidder_name]"
                                            name="bidders[{{ $loop->index }}][bidder_name]"
                                            placeholder="ชื่อผู้เสนอราคา"
                                            value="{{ old('bidders.' . $loop->index . '.bidder_name', $bidder->bidder_name) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="bidders[{{ $loop->index }}][bidder_position]"
                                            class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                            id="bidders[{{ $loop->index }}][bidder_position]"
                                            name="bidders[{{ $loop->index }}][bidder_position]" placeholder="ตำแหน่ง"
                                            value="{{ old('bidders.' . $loop->index . '.bidder_position', $bidder->bidder_position) }}">
                                    </div>
                                </div>
                            @endforeach
                            <!-- ฟอร์มสำหรับการเพิ่มผู้เสนอราคาใหม่ -->
                            @if (!isset($info->id))
                                <!-- ฟอร์มสำหรับผู้เสนอราคาใหม่ 1 -->
                                <div class="bidder-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="bidders[0][bidder_name]" class="form-label">ชื่อผู้เสนอราคา</label>
                                        <input type="text" class="form-control" id="bidders[0][bidder_name]"
                                            name="bidders[0][bidder_name]" placeholder="ชื่อผู้เสนอราคา">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="bidders[0][bidder_position]" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="bidders[0][bidder_position]"
                                            name="bidders[0][bidder_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                                <!-- ฟอร์มสำหรับผู้เสนอราคาใหม่ 2 -->
                                <div class="bidder-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="bidders[1][bidder_name]" class="form-label">ชื่อผู้เสนอราคา</label>
                                        <input type="text" class="form-control" id="bidders[1][bidder_name]"
                                            name="bidders[1][bidder_name]" placeholder="ชื่อผู้เสนอราคา">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="bidders[1][bidder_position]" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="bidders[1][bidder_position]"
                                            name="bidders[1][bidder_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Inspectors Section -->
                    <div class="mb-3">
                        <h4>ผู้ตรวจสอบ</h4>
                        <div id="inspectors-container">
                            @foreach ($info->inspectors as $inspector)
                                <div class="inspector-entry mb-3">
                                    <input type="hidden" name="inspectors[{{ $loop->index }}][id]"
                                        value="{{ $inspector->id }}">
                                    <div class="mb-2">
                                        <label for="inspectors[{{ $loop->index }}][inspector_name]"
                                            class="form-label">ชื่อผู้ตรวจสอบ</label>
                                        <input type="text" class="form-control"
                                            id="inspectors[{{ $loop->index }}][inspector_name]"
                                            name="inspectors[{{ $loop->index }}][inspector_name]"
                                            placeholder="ชื่อผู้ตรวจสอบ"
                                            value="{{ old('inspectors.' . $loop->index . '.inspector_name', $inspector->inspector_name) }}">
                                    </div>
                                    <div class="mb-2">
                                        <label for="inspectors[{{ $loop->index }}][inspector_position]"
                                            class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                            id="inspectors[{{ $loop->index }}][inspector_position]"
                                            name="inspectors[{{ $loop->index }}][inspector_position]"
                                            placeholder="ตำแหน่ง"
                                            value="{{ old('inspectors.' . $loop->index . '.inspector_position', $inspector->inspector_position) }}">
                                    </div>
                                </div>
                            @endforeach
                            <!-- ฟอร์มสำหรับการเพิ่มผู้ตรวจสอบใหม่ -->
                            @if (!isset($info->id))
                                <div class="inspector-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[0][inspector_name]"
                                            class="form-label">ชื่อผู้ตรวจสอบ</label>
                                        <input type="text" class="form-control" id="inspectors[0][inspector_name]"
                                            name="inspectors[0][inspector_name]" placeholder="ชื่อผู้ตรวจสอบ">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[0][inspector_position]" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="inspectors[0][inspector_position]"
                                            name="inspectors[0][inspector_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                                <div class="inspector-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[1][inspector_name]"
                                            class="form-label">ชื่อผู้ตรวจสอบ</label>
                                        <input type="text" class="form-control" id="inspectors[1][inspector_name]"
                                            name="inspectors[1][inspector_name]" placeholder="ชื่อผู้ตรวจสอบ">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[1][inspector_position]" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="inspectors[1][inspector_position]"
                                            name="inspectors[1][inspector_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                                <div class="inspector-entry mb-3 d-flex flex-wrap">
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[2][inspector_name]"
                                            class="form-label">ชื่อผู้ตรวจสอบ</label>
                                        <input type="text" class="form-control" id="inspectors[2][inspector_name]"
                                            name="inspectors[2][inspector_name]" placeholder="ชื่อผู้ตรวจสอบ">
                                    </div>
                                    <div class="flex-fill mb-2 me-2">
                                        <label for="inspectors[2][inspector_position]" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="inspectors[2][inspector_position]"
                                            name="inspectors[2][inspector_position]" placeholder="ตำแหน่ง">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="submit"
                            class="btn btn-primary">{{ empty($info->id) ? 'บันทึก' : 'อัพเดต' }}</button>
                        <a href="{{ url('/page') }}" class="btn btn-danger">ยกเลิก</a>
                    </div>
            </form>
            <script>
                function addProduct() {
                    const container = document.getElementById('products-container');
                    const index = container.children.length;
                    const template = `
                                <div class="product-entry mb-3 d-flex">
                            <div class="flex-grow-1 mb-2 me-2">
                                <label for="products[${index}][product_name]" class="form-label">ชื่อผลิตภัณฑ์</label>
                                <input type="text" class="form-control" id="products[${index}][product_name]" name="products[${index}][product_name]" placeholder="ชื่อผลิตภัณฑ์">
                            </div>
                            <div class="mb-2 me-2" style="flex-basis: 150px;">
                                <label for="products[${index}][quantity]" class="form-label">จำนวน</label>
                                <input type="number" class="form-control" id="products[${index}][quantity]" name="products[${index}][quantity]" placeholder="จำนวน">
                            </div>
                            <div class="mb-2" style="flex-basis: 150px;">
                                <label for="products[${index}][product_price]" class="form-label">ราคาผลิตภัณฑ์</label>
                                <input type="text" class="form-control" id="products[${index}][product_price]" name="products[${index}][product_price]" placeholder="ราคาผลิตภัณฑ์">
                            </div>
                        </div>

    `;
                    container.insertAdjacentHTML('beforeend', template);
                }
            </script>
        </div>
    </div>
    </div>
@endsection
