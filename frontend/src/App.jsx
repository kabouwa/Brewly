
import { useEffect, useState } from 'react'
import './App.css'
import axios from 'axios';


const BACKEND_URL = "http://localhost:8000/"
const API_URL = BACKEND_URL + 'api/';

const api = axios.create({
    baseURL: BACKEND_URL,
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        Accept: 'application/json',
    },
});

function App() {
  const [data, setData] = useState({});

  
  const load = async () => {
    
    try {
      await api.get('sanctum/csrf-cookie');

      const response = await api.get('api/user', {
        'email' : 'mohammed@mail.com',
        'password' : 'password',
      })
      
      setData(response.data);
    }catch (error) {
        console.log(error.response?.data);
    }

    
  }


  useEffect(() => {
    load();
  }, [])

  return (
    <div>
      {
        JSON.stringify(data)
      }
    </div>
  )
}

export default App
