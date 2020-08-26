import React from 'react'
import { Link } from 'react-router-dom'

const Header = () => (
    <nav className='navbar'>
        <div className='container'>
            <Link className='navbar-brand' to='/'>Houseplants</Link>
        </div>
    </nav>
)

export default Header
