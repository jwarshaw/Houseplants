import axios from 'axios'
import React, { Component } from 'react'

class HouseplantShow extends Component {
    constructor(props) {
        super(props)

        this.state = {
            houseplant: {},
            notes: []
        }

        this.handleRemoveHouseplant = this.handleRemoveHouseplant.bind(this)
    }

    componentDidMount() {
        const houseplantId = this.props.match.params.id

        axios.get(`/api/houseplants/${houseplantId}`).then(response => {
            console.log(response)
            this.setState({
                houseplant: response.data.houseplant,
                notes: [],
            })
        })
    }

    handleRemoveHouseplant() {
        const { history } = this.props

        axios.delete(`/api/houseplants/${this.state.houseplant.id}`)
            .then(response => history.push('/'))
    }

    render() {
        const { houseplant, notes } = this.state

        return (
            <div className='container py-4'>
                <div className='row justify-content-center'>
                    <div className='col-md-8'>
                        <h4>{houseplant.name}</h4>
                        <p>{houseplant.recommended_care}</p>
                        <button
                            className='btn btn-outline-danger btn-md'
                            onClick={this.handleRemoveHouseplant}
                        >
                            Remove Plant
                        </button>
                        <div className='card'>
                            <div className='card-body'>
                                <hr />
                                <ul className='list-group mt-3'>
                                    {notes.map(note => (
                                        <li
                                            className='list-group-item d-flex justify-content-between align-items-center'
                                            key={note.id}
                                        >
                                            {note.date}
                                            {note.height_inches}
                                            {note.watered}
                                            {note.water_cups}
                                            {note.comment}
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default HouseplantShow
