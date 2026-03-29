@extends('layouts.admin')
@section('title', 'المجلس الإداري')
@section('page-title', 'المجلس الإداري')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="font-headline text-xl font-black text-slate-900">تتبع المجلس الإداري</h2>
  <button class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-bold active:scale-95">إضافة مجلس جديد</button>
</div>
<div class="bg-surface-container-lowest rounded-md overflow-hidden">
  <table class="data-table">
    <thead><tr><th>رت</th><th>الدورة</th><th>العام</th><th>تاريخه</th><th>مكانه</th><th>إجراءات</th></tr></thead>
    <tbody>
      @php $sessions = [
        [1,'دجنبر',2018,'2017-12-11','مقر ولاية جهة سوس ماسة'],
        [2,'دجنبر',2021,'2021-12-03','مقر ولاية جهة سوس ماسة'],
        [3,'دجنبر',2022,'2022-12-07','مقر ولاية جهة سوس ماسة'],
        [4,'دجنبر',2023,'2023-12-09','ولاية جهة سوس ماسة'],
      ]; @endphp
      @foreach($sessions as [$id,$session,$year,$date,$place])
        <tr>
          <td>{{ $id }}</td>
          <td><span class="badge" style="background:#fef3c7;color:#b45309">{{ $session }}</span></td>
          <td>{{ $year }}</td>
          <td>{{ $date }}</td>
          <td>{{ $place }}</td>
          <td><div class="flex gap-1">
            <button class="icon-action" style="background:#dbeafe;color:#1d4ed8"><span class="material-symbols-outlined text-sm">search</span></button>
            <button class="icon-action" style="background:#fef3c7;color:#b45309"><span class="material-symbols-outlined text-sm">edit</span></button>
            <button class="icon-action" style="background:#fee2e2;color:#b91c1c"><span class="material-symbols-outlined text-sm">delete</span></button>
          </div></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
