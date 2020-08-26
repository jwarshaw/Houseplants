import axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'

class HouseplantsIndex extends Component {
    constructor(props) {
        super(props)

        this.state = {
            houseplants: []
        }
    }

    componentDidMount() {
        axios.get('/api/houseplants').then(response => {
            this.setState({
                houseplants: response.data.houseplants
            })
        })
    }

    render() {
        const { houseplants } = this.state

        return (
            <div className="container py-4" >
                <div className="row justify-content-center">
                    <div className="col-md-8 justify-content-center">
                        <Link className='btn btn-outline-primary btn-lg mb-3' to='/create'>
                            New Plant
                        </Link>
                        <ul className='list-group list-group-flush'>
                            {houseplants.map(houseplant => (
                                <Link
                                    className='list-group-item list-group-item-action d-flex justify-content-between align-items-center'
                                    to={`/${houseplant.id}`}
                                    key={houseplant.id}
                                >
                                    {houseplant.name}
                                </Link>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}

export default HouseplantsIndex
