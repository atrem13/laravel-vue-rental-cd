// home
import Home from './pages/Home'

// member
import IndexMember from './pages/member/Index'
import CreateMember from './pages/member/Create'
import EditMember from './pages/member/Edit'

// distributor
import IndexDistributor from './pages/distributor/Index'
import CreateDistributor from './pages/distributor/Create'
import EditDistributor from './pages/distributor/Edit'

// kategori kaset
import IndexKategoriKaset from './pages/kategori_kaset/Index'
import CreateKategoriKaset from './pages/kategori_kaset/Create'
import EditKategoriKaset from './pages/kategori_kaset/Edit'

// kategori kaset
import IndexKategoriFilm from './pages/kategori_film/Index'
import CreateKategoriFilm from './pages/kategori_film/Create'
import EditKategoriFilm from './pages/kategori_film/Edit'

// rak
import IndexRak from './pages/rak/Index'
import CreateRak from './pages/rak/Create'
import EditRak from './pages/rak/Edit'

// kaset
import IndexKaset from './pages/kaset/Index'
import CreateKaset from './pages/kaset/Create'
import EditKaset from './pages/kaset/Edit'

// penyewaan
import IndexPenyewaan from './pages/penyewaan/Index'
import CreatePenyewaan from './pages/penyewaan/Create'
import EditPenyewaan from './pages/penyewaan/Edit'

// detail penyewaan
import IndexDetailPenyewaan from './pages/detail_penyewaan/Index'

// pengembali
import IndexPengembalian from './pages/pengembalian/Index'

// booking penyewaan
import IndexBookingPenyewaan from './pages/booking_penyewaan/Index'
import CreateBookingPenyewaan from './pages/booking_penyewaan/Create'
import EditBookingPenyewaan from './pages/booking_penyewaan/Edit'

// detail booking penyewaan
import IndexDetailBookingPenyewaan from './pages/detail_booking_penyewaan/Index'

// booking penyewaan tersedia
import IndexBookingPenyewaanTersedia from './pages/booking_penyewaan_tersedia/Index'

export const routes = [
    // home
    {
        name:'home',
        path:'/',
        component:Home
    },
    // member
    {
        name:'member',
        path:'/member',
        component:IndexMember
    },
    {
        name:'member-create',
        path:'/member/create',
        component:CreateMember
    },
    {
        name:'member-edit',
        path:'/member/edit',
        component:EditMember
    },
    // distributor
    {
        name:'distributor',
        path:'/distributor',
        component:IndexDistributor
    },
    {
        name:'distributor-create',
        path:'/distributor/create',
        component:CreateDistributor
    },
    {
        name:'distributor-edit',
        path:'/distributor/edit',
        component:EditDistributor
    },
    // kategori kaset
    {
        name:'kategori-kaset',
        path:'/kategori-kaset',
        component: IndexKategoriKaset
    },
    {
        name:'kategori-kaset-create',
        path:'/kategori-kaset/create',
        component:CreateKategoriKaset
    },
    {
        name:'kategori-kaset-edit',
        path:'/kategori-kaset/edit',
        component:EditKategoriKaset
    },
    // kategori film
    {
        name:'kategori-film',
        path:'/kategori-film',
        component: IndexKategoriFilm
    },
    {
        name:'kategori-film-create',
        path:'/kategori-film/create',
        component:CreateKategoriFilm
    },
    {
        name:'kategori-film-edit',
        path:'/kategori-film/edit',
        component:EditKategoriFilm
    },
    // rak
    {
        name:'rak',
        path:'/rak',
        component:IndexRak
    },
    {
        name:'rak-create',
        path:'/rak/create',
        component:CreateRak
    },
    {
        name:'rak-edit',
        path:'/rak/edit',
        component:EditRak
    },
    // kaset
    {
        name:'kaset',
        path:'/kaset',
        component:IndexKaset
    },
    {
        name:'kaset-create',
        path:'/kaset/create',
        component:CreateKaset
    },
    {
        name:'kaset-edit',
        path:'/kaset/edit',
        component:EditKaset
    },
    // penyewaan
    {
        name:'penyewaan',
        path:'/penyewaan',
        component:IndexPenyewaan
    },
    {
        name:'penyewaan-create',
        path:'/penyewaan/create',
        component:CreatePenyewaan
    },
    {
        name:'penyewaan-edit',
        path:'/penyewaan/edit',
        component:EditPenyewaan
    },
    // detail penyewaan
    {
        name:'detail-penyewaan',
        path:'/detail-penyewaan',
        component:IndexDetailPenyewaan
    },
    // pengembalian
    {
        name:'pengembalian',
        path:'/pengembalian',
        component:IndexPengembalian
    },
    // booking penyewaan
    {
        name:'booking-penyewaan',
        path:'/booking-penyewaan',
        component:IndexBookingPenyewaan
    },
    {
        name:'booking-penyewaan-create',
        path:'/booking-penyewaan/create',
        component:CreateBookingPenyewaan
    },
    {
        name:'booking-penyewaan-edit',
        path:'/booking-penyewaan/edit',
        component:EditBookingPenyewaan
    },
    // detail booking penyewaan
    {
        name:'detail-booking-penyewaan',
        path:'/detail-booking-penyewaan',
        component:IndexDetailBookingPenyewaan
    },
    // booking penyewaan tersedia
    {
        name:'booking-penyewaan-tersedia',
        path:'/booking-penyewaan-tersedia',
        component:IndexBookingPenyewaanTersedia
    },

]
