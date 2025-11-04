import { InputWithLabel } from '@/components/cyp/input-with-label';
import { SelectWithLabel } from '@/components/cyp/select-with-label';
import { FormWrapper } from '@/pages/shared/components/form-wrapper';

export default function EntryForm(props: any) {
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
                dataKey="doctor-json"
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
