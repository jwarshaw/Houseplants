import axios from 'axios'
import React, { Component } from 'react'

class HouseplantShow extends Component {
    constructor(props) {
        super(props)

        this.state = {
            houseplant: {},
            notes: [],
            date: '',
            water_cups: '',
            height_inches: '',
        }

        this.handleRemoveHouseplant = this.handleRemoveHouseplant.bind(this)
        this.handleNoteChange = this.handleNoteChange.bind(this)
        this.handleCreateNote = this.handleCreateNote.bind(this)
        this.handleRemoveNote = this.handleRemoveNote.bind(this)
    }

    componentDidMount() {
        const houseplantId = this.props.match.params.id

        axios.get(`/api/houseplants/${houseplantId}`).then(response => {
            this.setState({
                houseplant: response.data.houseplant,
                notes: response.data.houseplant.notes,
            })
        })
    }

    handleRemoveHouseplant() {
        const { history } = this.props

        axios.delete(`/api/houseplants/${this.state.houseplant.id}`)
            .then(response => history.push('/'))
    }

    handleNoteChange(e) {
        const name = e.target.name
        const value = e.target.value
        this.setState({
            [name]: value
        })
    }

    handleCreateNote(e) {
        e.preventDefault()

        const payload = {
            date: this.state.date,
            water_cups: this.state.water_cups,
            height_inches: this.state.height_inches,
        }

        axios.post(`/api/houseplants/${this.state.houseplant.id}/notes`, payload).then(response => {
            this.setState(prevState => ({
                notes: prevState.notes.concat(response.data.note)
            }))
        })
    }

    handleRemoveNote(noteId) {
        axios.delete(`/api/notes/${noteId}`)
            .then(response => {
                this.setState(prevState => ({
                    notes: prevState.notes.filter(note => {
                        return note.id !== noteId
                    })
                }))
            })
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
                        <div>
                            <hr />
                            <form onSubmit={this.handleCreateNote}>
                                <div className='input-group'>
                                    <input
                                        type='date'
                                        name='date'
                                        className='form-control'
                                        value={this.state.date}
                                        onChange={this.handleNoteChange}
                                    />
                                    <input
                                        type='number'
                                        name='water_cups'
                                        className='form-control'
                                        placeholder='Water (cups)'
                                        value={this.state.water_cups}
                                        onChange={this.handleNoteChange}
                                    />
                                    <input
                                        type='number'
                                        name='height_inches'
                                        className='form-control'
                                        placeholder='Height (inches)'
                                        value={this.state.height_inches}
                                        onChange={this.handleNoteChange}
                                    />
                                    <div>
                                        <button className='btn btn-primary'>New</button>
                                    </div>
                                </div>
                            </form>
                            <ul className='list-group mt-3'>
                                {notes.sort((a, b) => (a.date > b.date ? 1 : -1)).map(note => (
                                    <li
                                        className='list-group-item d-flex justify-content-between align-items-center'
                                        key={note.id}
                                    >
                                        <span>{note.date}</span>
                                        <span>{note.water_cups}</span>
                                        <span>{note.height_inches}</span>
                                        <span>
                                            <button
                                                className='btn btn-outline-danger btn-sm'
                                                onClick={() => this.handleRemoveNote(note.id)}
                                            >
                                                X
                                            </button>
                                        </span>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default HouseplantShow
