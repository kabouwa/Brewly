import { BrowserRouter, Route, Routes } from 'react-router-dom'
import PublicLayout from './components/Layouts/public/PublicLayout'
import Home from './pages/Home/Home'
import Menu from './pages/Home/Menu'
import { useEffect } from 'react'
import { productsApi } from './api/products'

function App() {
  const load = async () => {
    try {
          const res = await productsApi.all();
          const data = res.data;
          console.log(data);
          
    }catch(err) {
      console.log(err);
    }
  }
  useEffect(() => {
    load()
  }, []);

  return (
    <BrowserRouter>
      <Routes>
          {/* Public Pages */}
          <Route element={<PublicLayout />}>
              <Route index element={<Home/>} />
              <Route path='menu' element={<Menu/>} />
          </Route>

          {/* Management Pages */}
          <Route>

          </Route>

          <Route path='*' element={<h3 className='my-10 text-center text-coffee font-bold text-8xl'>404 - Not found ! </h3>} />

      </Routes>
    </BrowserRouter>
  )
}

export default App