import { InputWithLabel } from '@/components/cyp/input-with-label';
import { SelectWithLabel } from '@/components/cyp/select-with-label';
import { FormWrapper } from '@/pages/shared/components/form-wrapper';

export function EntryForm(props: any) {
    return (
        <FormWrapper {...props}>
            <InputWithLabel
                label="Patient Name"
                id="patient_name"
                placeholder="Enter patient name"
                col={6}
                {...props.register('patient_name')}
                required
            />
            <SelectWithLabel
                label="Doctor"
                id="doctor"
                placeholder="Select doctor"
                module="consultation"
                dataKey="doctors"
                col={6}
                {...props.register('doctor')}
            />
        </FormWrapper>
    );
}

export function ReportForm(props: any) {
    return (
        <FormWrapper {...props}>
            <SelectWithLabel
                label="Doctor"
                id="doctor"
                placeholder="Select doctor"
                module="consultation"
                dataKey="doctors"
                col={6}
            />

            <SelectWithLabel
                label="Mode"
                id="mode"
                placeholder="Select mode"
                module="mode"
                dataKey="consultation_modes"
                col={6}
            />

            <InputWithLabel
                label="Start Date"
                id="start_date"
                placeholder="Start Date"
                col={6}
                {...props.register('start_date')}
                type="date"
            />

            <InputWithLabel
                label="End Date"
                id="end_date"
                placeholder="End Date"
                col={6}
                {...props.register('end_date')}
                type="date"
            />
        </FormWrapper>
    );
}

export function SettingsForm(props: any) {
    return (
        <FormWrapper {...props}>
            <InputWithLabel
                label="Patient Name"
                id="patient_name"
                placeholder="Enter patient name"
                col={6}
                {...props.register('patient_name')}
                required
            />

            <InputWithLabel
                label="Age"
                id="age"
                placeholder="Enter age"
                col={6}
                {...props.register('age')}
                required
                type="number"
            />

            <SelectWithLabel
                label="Doctor"
                id="doctor"
                placeholder="Select doctor"
                module="consultation"
                dataKey="doctors"
                col={6}
            />

            <InputWithLabel
                label="Fee"
                id="fee"
                placeholder="Enter fee"
                col={6}
                {...props.register('fee')}
                required
                type="number"
            />

            <InputWithLabel
                label="Location"
                id="location"
                placeholder="Enter Location"
                col={6}
                {...props.register('location')}
            />
        </FormWrapper>
    );
}
