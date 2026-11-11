
const $=s=>document.querySelector(s),$$=s=>[...document.querySelectorAll(s)];
const sb=$('#sidebar'),ov=$('#overlay');
function side(o){sb&&sb.classList.toggle('open',o);ov&&ov.classList.toggle('show',o)}
$('#openSide')&&$('#openSide').addEventListener('click',()=>side(true));
$('#closeSide')&&$('#closeSide').addEventListener('click',()=>side(false));
ov&&ov.addEventListener('click',()=>side(false));
const t=$('#today');if(t)t.textContent=new Date().toLocaleDateString('en-US',{weekday:'long',month:'short',day:'numeric'});
// show / hide password
$$('[data-eye]').forEach(b=>b.addEventListener('click',()=>{const i=$(b.dataset.eye);const s=i.type==='password';i.type=s?'text':'password';b.innerHTML=s?'<i class="bi bi-eye-slash"></i>':'<i class="bi bi-eye"></i>'}));
// sign-in validation
const lf=$('#loginForm');
if(lf)lf.addEventListener('submit',e=>{e.preventDefault();let ok=true;const em=$('#email'),pw=$('#password');
 em.classList.toggle('is-invalid',!(ok=em.value.includes('@'))&&true);
 const v=em.value.includes('@'),p=pw.value.length>=6;
 em.classList.toggle('is-invalid',!v);pw.classList.toggle('is-invalid',!p);
 $('#emailErr').textContent=em.value?'Please enter a valid email':'Email is required';
 $('#passErr').textContent=pw.value?'Password must be at least 6 characters':'Password is required';
 if(v&&p)location.href='dashboard.html'});
// forgot password
const ff=$('#forgotForm');
if(ff)ff.addEventListener('submit',e=>{e.preventDefault();const em=$('#email');const v=em.value.includes('@');em.classList.toggle('is-invalid',!v);
 $('#emailErr').textContent=em.value?'Please enter a valid email':'Email is required';
 if(v){ff.classList.add('d-none');$('#sent').classList.remove('d-none')}});
// search + select filter for tables (results, invoices)
const q=$('#q'),sel=$('#sel');
if(q){const rows=$$('tbody tr[data-s]');const run=()=>{let n=0;rows.forEach(r=>{const ok=r.dataset.s.includes(q.value.toLowerCase())&&(!sel||sel.value==='all'||r.dataset.c===sel.value);r.classList.toggle('d-none',!ok);n+=ok});$('#empty').classList.toggle('d-none',n>0)};
 q.addEventListener('input',run);sel&&sel.addEventListener('change',run)}
// course filter buttons
$$('.chip-f').forEach(b=>b.addEventListener('click',()=>{$$('.chip-f').forEach(x=>x.classList.remove('active'));b.classList.add('active');let n=0;
 $$('#grid [data-status]').forEach(c=>{const ok=b.dataset.f==='all'||(b.dataset.f==='active'&&c.dataset.status==='active')||(b.dataset.f==='withdraw'&&c.dataset.status==='withdraw');c.classList.toggle('d-none',!ok);n+=ok});
 $('#shown').textContent=n;$('#empty').classList.toggle('d-none',n>0)}));
