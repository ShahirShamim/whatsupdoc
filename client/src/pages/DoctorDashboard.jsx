import { useState, useEffect } from 'react';
import axios from 'axios';
import Button from '../components/Button';
import Input from '../components/Input';

const DoctorDashboard = ({ user }) => {
    const [appointments, setAppointments] = useState([]);
    const [slots, setSlots] = useState([]);
    const [newSlot, setNewSlot] = useState({ date: '', start: '', end: '' });
    const [activeTab, setActiveTab] = useState('schedule');

    useEffect(() => {
        fetchAppointments();
        fetchMySlots();
    }, []);

    const fetchAppointments = async () => {
        try {
            const res = await axios.get(`http://localhost:3000/appointments/user/${user.id}?role=doctor`);
            setAppointments(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    const fetchMySlots = async () => {
        try {
            const res = await axios.get(`http://localhost:3000/doctors/${user.id}/slots`);
            setSlots(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    const handleCreateSlot = async (e) => {
        e.preventDefault();
        try {
            await axios.post('http://localhost:3000/doctors/slots', {
                doctor_id: user.id,
                slot_date: newSlot.date,
                start_time: newSlot.start,
                end_time: newSlot.end
            });
            alert('Slot created!');
            fetchMySlots();
            setNewSlot({ date: '', start: '', end: '' });
        } catch (err) {
            alert(err.response?.data?.error || 'Failed to create slot');
        }
    };

    return (
        <div>
            <div className="flex border-b border-gray-200 mb-8">
                <button
                    onClick={() => setActiveTab('schedule')}
                    className={`px-6 py-4 text-sm font-medium transition-colors border-b-2 ${activeTab === 'schedule' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'}`}
                >
                    My Schedule
                </button>
                <button
                    onClick={() => setActiveTab('slots')}
                    className={`px-6 py-4 text-sm font-medium transition-colors border-b-2 ${activeTab === 'slots' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'}`}
                >
                    Manage Slots
                </button>
            </div>

            {activeTab === 'schedule' ? (
                <div className="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <table className="w-full text-left">
                        <thead className="bg-gray-50 text-gray-500 uppercase text-xs">
                            <tr>
                                <th className="p-4 font-medium">Date</th>
                                <th className="p-4 font-medium">Time</th>
                                <th className="p-4 font-medium">Patient</th>
                                <th className="p-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-100">
                            {appointments.length === 0 && <tr><td colSpan="4" className="p-6 text-center text-gray-500 text-sm">No scheduled appointments.</td></tr>}
                            {appointments.map(apt => (
                                <tr key={apt.id} className="hover:bg-gray-50/50">
                                    <td className="p-4 text-gray-900">{new Date(apt.slot_date).toLocaleDateString()}</td>
                                    <td className="p-4 text-gray-600 font-medium">{apt.start_time}</td>
                                    <td className="p-4 font-medium text-gray-900">{apt.patient_name}</td>
                                    <td className="p-4"><span className="bg-green-50 text-green-700 border border-green-100 px-2.5 py-0.5 rounded-full text-xs font-medium">{apt.status}</span></td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            ) : (
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div className="col-span-1">
                        <div className="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                            <h3 className="text-lg font-bold text-gray-900 mb-5">Create Availability</h3>
                            <form onSubmit={handleCreateSlot} className="space-y-1">
                                <Input label="Date" type="date" value={newSlot.date} onChange={e => setNewSlot({ ...newSlot, date: e.target.value })} required />
                                <div className="grid grid-cols-2 gap-4">
                                    <Input label="Start" type="time" value={newSlot.start} onChange={e => setNewSlot({ ...newSlot, start: e.target.value })} required />
                                    <Input label="End" type="time" value={newSlot.end} onChange={e => setNewSlot({ ...newSlot, end: e.target.value })} required />
                                </div>
                                <Button type="submit" className="mt-4">Publish Slot</Button>
                            </form>
                        </div>
                    </div>

                    <div className="col-span-1 lg:col-span-2">
                        <h3 className="text-lg font-bold text-gray-900 mb-5">Active Slots</h3>
                        <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                            {slots.map(slot => (
                                <div key={slot.id} className="bg-white p-4 rounded-lg border border-gray-200 text-center shadow-sm">
                                    <p className="font-semibold text-gray-900">{slot.start_time.slice(0, 5)} - {slot.end_time.slice(0, 5)}</p>
                                    <p className="text-xs text-gray-500 mt-1">{new Date(slot.slot_date).toLocaleDateString()}</p>
                                    <div className="mt-3 inline-block px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider rounded">Open</div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};
export default DoctorDashboard;
