import axios from 'axios'
import React, { Component } from 'react'

class HouseplantCreate extends Component {
    constructor(props) {
        super(props)
        console.log('HERE')

        this.state = {
            name: '',
            recommended_care: '',
        }

        this.handleChange = this.handleChange.bind(this)
        this.handleCreateHouseplant = this.handleCreateHouseplant.bind(this)
    }

    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        })
    }

    handleCreateHouseplant(e) {
        e.preventDefault()

        const { history } = this.props

        const houseplant = {
            name: this.state.name,
            recommended_care: this.state.recommended_care
        }

        axios.post('/api/houseplants', houseplant)
            .then(response => {
                history.push('/')
            })
            .catch(error => {
                // Handle errors here
            })
    }

    render() {
        return (
            <div className='container py-4'>
                <div className='row justify-content-center'>
                    <div className='col-md-6'>
                        <h3>New Houseplant</h3>
                        <div className='card'>
                            <div className='card-body'>
                                <form onSubmit={this.handleCreateHouseplant}>
                                    <div className='form-group'>
                                        <label htmlFor='name'>Name</label>
                                        <input
                                            id='name'
                                            type='text'
                                            className='form-control'
                                            name='name'
                                            value={this.state.name}
                                            onChange={this.handleChange}
                                        />
                                    </div>
                                    <div className='form-group'>
                                        <label htmlFor='recommended_care'>Recommended Care</label>
                                        <textarea
                                            id='recommended_care'
                                            className="form-control"
                                            name='recommended_care'
                                            rows='10'
                                            value={this.state.recommended_care}
                                            onChange={this.handleChange}
                                        />
                                    </div>
                                    <button className='btn btn-primary btn-lg'>Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default HouseplantCreate
